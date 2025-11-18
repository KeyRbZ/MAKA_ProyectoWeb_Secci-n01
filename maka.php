<?php
session_start();
require_once 'conexion.php';

$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;
$mensaje = '';
$presupuestos = [];


if ($usuario_id) {
    echo "Conexión exitosa<br>";
    echo "Usuario ID: $usuario_id<br>";
}


$conn = $conexion;


function obtenerPresupuestos($connection, $user_id) {
    if (!$user_id) return [];
    
    $sql = "SELECT 
                p.id,
                p.nombre_presupuesto,
                p.fecha_creacion,
                p.fecha_actualizacion,
                i.ingreso_semanal,
                gfo.alimentacion_basica,
                gfo.transporte,
                gfo.materiales_estudio,
                gfo.telefono_datos,
                gfr.comida_fuera_casa,
                gfr.impresiones_papeleria,
                gv.salidas_amigos,
                gv.entretenimiento_hobbies,
                a.aportaciones_ahorro,
                a.capacidad_ahorro_adicional,
                r.total_ingresos,
                r.total_gastos,
                r.total_fijos_obligatorios,
                r.total_fijos_reducibles,
                r.total_variables
            FROM presupuestos p
            LEFT JOIN ingresos i ON p.id = i.presupuesto_id
            LEFT JOIN gastos_fijos_obligatorios gfo ON p.id = gfo.presupuesto_id
            LEFT JOIN gastos_fijos_reducibles gfr ON p.id = gfr.presupuesto_id
            LEFT JOIN gastos_variables gv ON p.id = gv.presupuesto_id
            LEFT JOIN ahorros a ON p.id = a.presupuesto_id
            LEFT JOIN resumen_presupuesto r ON p.id = r.presupuesto_id
            WHERE p.usuario_id = ?
            ORDER BY p.fecha_creacion DESC";
    
    $stmt = $connection->prepare($sql);
    if (!$stmt) {
        die("Error en prepare: " . $connection->error);
    }
    
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $presupuestos = [];
    while ($row = $result->fetch_assoc()) {
        $presupuestos[] = $row;
    }
    
    return $presupuestos;
}

if ($usuario_id) {
    $presupuestos = obtenerPresupuestos($conn, $usuario_id);
}


function guardarPresupuesto($connection, $user_id, $datos) {
    if (!$user_id) {
        throw new Exception("Debe iniciar sesión para guardar presupuestos");
    }
    
    $connection->begin_transaction();
    
    try {

        $sql_presupuesto = "INSERT INTO presupuestos (usuario_id, nombre_presupuesto) VALUES (?, 'Presupuesto Principal')";
        $stmt_presupuesto = $connection->prepare($sql_presupuesto);
        $stmt_presupuesto->bind_param("i", $user_id);
        $stmt_presupuesto->execute();
        $presupuesto_id = $connection->insert_id;
        

        $sql_ingresos = "INSERT INTO ingresos (presupuesto_id, ingreso_semanal) VALUES (?, ?)";
        $stmt_ingresos = $connection->prepare($sql_ingresos);
        $ingreso_semanal = floatval($datos['ingresoSemanal']);
        $stmt_ingresos->bind_param("id", $presupuesto_id, $ingreso_semanal);
        $stmt_ingresos->execute();
        

        $sql_fijos_obligatorios = "INSERT INTO gastos_fijos_obligatorios (presupuesto_id, alimentacion_basica, transporte, materiales_estudio, telefono_datos) VALUES (?, ?, ?, ?, ?)";
        $stmt_fijos_obligatorios = $connection->prepare($sql_fijos_obligatorios);
        $gastos_fijos = $datos['gastos']['fijosObligatorios'];
        $stmt_fijos_obligatorios->bind_param("idddd", $presupuesto_id, $gastos_fijos, $gastos_fijos, $gastos_fijos, $gastos_fijos);
        $stmt_fijos_obligatorios->execute();
        

        $sql_fijos_reducibles = "INSERT INTO gastos_fijos_reducibles (presupuesto_id, comida_fuera_casa, impresiones_papeleria) VALUES (?, ?, ?)";
        $stmt_fijos_reducibles = $connection->prepare($sql_fijos_reducibles);
        $gastos_reducibles = $datos['gastos']['fijosReducibles'];
        $stmt_fijos_reducibles->bind_param("idd", $presupuesto_id, $gastos_reducibles, $gastos_reducibles);
        $stmt_fijos_reducibles->execute();
        

        $sql_variables = "INSERT INTO gastos_variables (presupuesto_id, salidas_amigos, entretenimiento_hobbies) VALUES (?, ?, ?)";
        $stmt_variables = $connection->prepare($sql_variables);
        $gastos_variables = $datos['gastos']['variables'];
        $stmt_variables->bind_param("idd", $presupuesto_id, $gastos_variables, $gastos_variables);
        $stmt_variables->execute();
        

        $sql_ahorros = "INSERT INTO ahorros (presupuesto_id, aportaciones_ahorro, capacidad_ahorro_adicional) VALUES (?, ?, ?)";
        $stmt_ahorros = $connection->prepare($sql_ahorros);
        $ahorro = floatval($datos['ahorro']['aportacion']);
        $capacidad_ahorro = floatval($datos['ahorro']['capacidadAdicional']);
        $stmt_ahorros->bind_param("idd", $presupuesto_id, $ahorro, $capacidad_ahorro);
        $stmt_ahorros->execute();
        

        $total_ingresos = $ingreso_semanal;
        $total_gastos = $gastos_fijos + $gastos_reducibles + $gastos_variables;
        
        $sql_resumen = "INSERT INTO resumen_presupuesto (presupuesto_id, total_ingresos, total_gastos, total_fijos_obligatorios, total_fijos_reducibles, total_variables) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_resumen = $connection->prepare($sql_resumen);
        $stmt_resumen->bind_param("iddddd", $presupuesto_id, $total_ingresos, $total_gastos, $gastos_fijos, $gastos_reducibles, $gastos_variables);
        $stmt_resumen->execute();
        
        $connection->commit();
        return $presupuesto_id;
        
    } catch (Exception $e) {
        $connection->rollback();
        throw $e;
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['guardar_presupuesto'])) {
        
        $datos = [
            'ingresoSemanal' => $_POST['ingresoSemanal'],
            'gastos' => [
                'fijosObligatorios' => $_POST['fijosObligatorios'],
                'fijosReducibles' => $_POST['fijosReducibles'],
                'variables' => $_POST['variables']
            ],
            'ahorro' => [
                'aportacion' => $_POST['aportacionAhorro'],
                'capacidadAdicional' => $_POST['capacidadAhorro']
            ]
        ];
        
        try {
            if ($usuario_id) {
                $presupuesto_id = guardarPresupuesto($conn, $usuario_id, $datos);
                $mensaje = "✅ Presupuesto guardado correctamente (ID: $presupuesto_id)";

                $presupuestos = obtenerPresupuestos($conn, $usuario_id);
            } else {

                $mensaje = "❌ Debes <a href='iniciar_sesion.php' style='color: #007bff;'>iniciar sesión</a> o <a href='registro.php' style='color: #007bff;'>crear una cuenta</a> para guardar presupuestos.";
            }
        } catch (Exception $e) {
            $mensaje = "❌ Error al guardar el presupuesto: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAKA - Calculadora de Gastos</title>
    <link rel="stylesheet" href="maka.css">
</head>
<body>
    <nav>
        <div class="menu">
            <div class="logo">
                <img src="archivos/1.png" alt="Logo MAKA">
            </div>
            <a href="inicio.html">Inicio</a>
            <div class="desplegable">
                <button>MAKA</button>
                <div class="menu-content">
                    <a href="maka.html">Calculadora de gastos</a>
                </div>
            </div>
            <a href="que_somos.html">¿Qué somos?</a>
            <a href="contactanos.html">Contáctanos</a>
            <a href="sugerencias.html">Sugerencias</a>
            <div class="boton">
                <?php if ($usuario_id): ?>
                    <span style="color: white; margin-right: 15px;">Bienvenido</span>
                    <button class="boton_cerrar_sesion" onclick="window.location.href='logout.php'">Cerrar Sesión</button>
                <?php else: ?>
                    <button class="boton_iniciar_sesion" onclick="window.location.href='iniciar_sesion.php'">Iniciar sesión</button>
                    <button class="boton_registro" onclick="window.location.href='registro.php'">Registrate</button>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1>Calculadora semanal de gastos para estudiantes</h1>
        
        <div class="description">
            <p>¿Sabe en qué destina su dinero como estudiante? ¿Tiene identificados sus gastos fijos y aquellos en los que podría realizar ajustes con mayor facilidad? Esta calculadora está diseñada especialmente para estudiantes que deseen llevar un control responsable de sus finanzas personales.</p>
            <p class="note">- Esta información no será recopilada, sin embargo si gustas tener guardado el progreso de tu presupuesto puedes iniciar sesión o crear una cuenta.</p>
        </div>

        <div class="content-grid">
            <!-- Columna Izquierda -->
            <div class="left-column">
                <!-- Sección Ingresos -->
                <section class="card">
                    <h2>Ingresos</h2>
                    <p class="section-description">Introduzca la cantidad de dinero con la que cuenta cada semana.</p>
                    
                    <div class="input-section">
                        <h3>Ingreso semanal</h3>
                        <input type="number" id="ingresoSemanal" min="0" placeholder="0">
                    </div>
                </section>

                <!-- Sección Gastos -->
                <section class="card">
                    <h2>Gastos</h2>
                    <p class="section-description">Introduzca sus gastos semanales.</p>
                    
                    <!-- Gastos Fijos Obligatorios -->
                    <div class="expense-category">
                        <h3 class="category-title">Fijos obligatorios</h3>
                        <div class="expense-inputs">
                            <div class="expense-item">
                                <span class="expense-label">Alimentación básica</span>
                                <input type="number" class="expense-amount" min="0" placeholder="0">
                            </div>
                            <div class="expense-item">
                                <span class="expense-label">Transporte</span>
                                <input type="number" class="expense-amount" min="0" placeholder="0">
                            </div>
                            <div class="expense-item">
                                <span class="expense-label">Materiales de estudio</span>
                                <input type="number" class="expense-amount" min="0" placeholder="0">
                            </div>
                            <div class="expense-item">
                                <span class="expense-label">Teléfono o datos móviles</span>
                                <input type="number" class="expense-amount" min="0" placeholder="0">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Gastos Fijos Reducibles -->
                    <div class="expense-category">
                        <h3 class="category-title">Fijos reducibles</h3>
                        <div class="expense-inputs">
                            <div class="expense-item">
                                <span class="expense-label">Comida fuera de casa</span>
                                <input type="number" class="expense-amount" min="0" placeholder="0">
                            </div>
                            <div class="expense-item">
                                <span class="expense-label">Impresiones o papelería extra</span>
                                <input type="number" class="expense-amount" min="0" placeholder="0">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Gastos Variables -->
                    <div class="expense-category">
                        <h3 class="category-title">Variables</h3>
                        <div class="expense-inputs">
                            <div class="expense-item">
                                <span class="expense-label">Salidas con amigos</span>
                                <input type="number" class="expense-amount" min="0" placeholder="0">
                            </div>
                            <div class="expense-item">
                                <span class="expense-label">Entretenimiento o hobbies</span>
                                <input type="number" class="expense-amount" min="0" placeholder="0">
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Columna Derecha -->
            <div class="right-column">
                <!-- Aportaciones al ahorro -->
                <section class="card">
                    <h2>Aportaciones al ahorro</h2>
                    <div class="input-section">
                        <input type="number" id="aportacionAhorro" min="0" placeholder="0">
                    </div>
                </section>

                <!-- Presupuesto -->
                <section class="card">
                    <h2>Presupuesto</h2>
                    <table class="budget-table">
                        <thead>
                            <tr>
                                <th>Total Ingresos</th>
                                <th>Total Gastos</th>
                                <th>Aportaciones al ahorro</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="totalIngresos">0</td>
                                <td id="totalGastos">0</td>
                                <td id="totalAhorro">0</td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div class="additional-savings">
                        <h3>Capacidad de ahorro adicional</h3>
                        <p id="capacidadAhorro">0</p>
                    </div>
                </section>

                <!-- Distribución -->
                <section class="card">
                    <h2>Distribución del gasto</h2>
                    
                    <div class="distribution">
                        <div class="distribution-item">
                            <span class="distribution-label">Fijos obligatorios</span>
                            <span class="distribution-value" id="fijosObligatoriosTotal">0</span>
                            <span class="distribution-percentage" id="fijosObligatoriosPorcentaje">0%</span>
                        </div>
                        <div class="distribution-item">
                            <span class="distribution-label">Fijos reducibles</span>
                            <span class="distribution-value" id="fijosReduciblesTotal">0</span>
                            <span class="distribution-percentage" id="fijosReduciblesPorcentaje">0%</span>
                        </div>
                        <div class="distribution-item">
                            <span class="distribution-label">Variables</span>
                            <span class="distribution-value" id="variablesTotal">0</span>
                            <span class="distribution-percentage" id="variablesPorcentaje">0%</span>
                        </div>
                    </div>
                    
                    <div class="savings-distribution">
                        <h3>Ahorro</h3>
                        <div class="distribution">
                            <div class="distribution-item">
                                <span class="distribution-label">Aportaciones al ahorro</span>
                                <span class="distribution-value" id="ahorroTotal">0</span>
                                <span class="distribution-percentage" id="ahorroPorcentaje">0%</span>
                            </div>
                            <div class="distribution-item">
                                <span class="distribution-label">Capacidad de ahorro adicional</span>
                                <span class="distribution-value" id="ahorroAdicionalTotal">0</span>
                                <span class="distribution-percentage" id="ahorroAdicionalPorcentaje">0%</span>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Botones -->
                <div class="action-buttons">
                    <button id="clearBtn" class="btn-secondary">Borrar</button>
                    <button id="saveBtn" class="btn-primary">
                        <?php echo $usuario_id ? 'Guardar' : 'Guardar (Requiere cuenta)'; ?>
                    </button>
                    <?php if ($usuario_id && count($presupuestos) > 0): ?>
                        <button class="toggle-presupuestos" onclick="togglePresupuestos()">
                            📊 Mostrar Mis Presupuestos (<?php echo count($presupuestos); ?>)
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-section links-section">
                <h3>Links</h3>
                <ul class="footer-links">
                    <li><a href="inicio.html">Inicio</a></li>
                    <li><a href="maka.html">Calculadora digital</a></li>
                    <li><a href="que_somos.html">¿Que somos?</a></li>
                    <li><a href="contactanos.html">Contactanos</a></li>
                    <li><a href="sugerencias.html">Sugerencias</a></li>
                </ul>
            </div>

            <div class="footer-section logo-section">
                <img src="archivos/1.png" alt="Logo MAKA" class="footer-logo">
            </div>

            <div class="footer-section info-section">
                <h3>Información general</h3>
                <ul class="contact-info">
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Building Number: 19, McCowan Road, Woodside Square</span>
                    </li>
                    <li>
                        <i class="fas fa-phone"></i>
                        <span>+1 416 835</span>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <span>MAKA@gmail.com</span>
                    </li>
                    <li>
                        <i class="fas fa-clock"></i>
                        <span>9:00 am - 5:00 pm de Lunes a Viernes</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="copyright">
                © 2025 MAKA. Derechos reservados.
            </div>
            <div class="legal-links">
                <a href="#">Política de privacidad</a>
                <a href="#">Términos y condiciones</a>
                <?php if ($usuario_id): ?>
                    <a href="logout.php" style="color: #ff6b6b; margin-left: 15px;">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
