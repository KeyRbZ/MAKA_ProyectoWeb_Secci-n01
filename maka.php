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
                <button class="boton_iniciar_sesion">Iniciar sesión</button>
                <button class="boton_registro">Registrate</button>
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
                    <button id="saveBtn" class="btn-primary">Guardar</button>
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
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>