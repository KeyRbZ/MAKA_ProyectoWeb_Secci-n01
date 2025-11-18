<?php
session_start();
$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAKA - Contactanos</title>
    <link rel="icon" type="icono" href="archivos/1.png">
    <link rel="stylesheet" href="contactanos.css">
    <link rel="icon" type="icono" href="archivos/BANNER MAKA.gif">
    <script src="https://kit.fontawesome.com/c80d489b0f.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav>
        <div class="menu">
            <div class="logo">
                <img src="archivos/1.png" alt="Logo MAKA">
            </div>
            <a href="inicio.php">Inicio</a>
            <div class="desplegable">
                <button>MAKA</button>
                <div class="menu-content">
                    <a href="maka.php">Calculadora de gastos</a>
                </div>
            </div>
            <a href="que_somos.php">¿Qué somos?</a>
            <a href="contactanos.php">Contáctanos</a>
            <a href="sugerencias.php">Sugerencias</a>
            <div class="boton">
                <?php if ($usuario_id): ?>
                <span style="color: white; margin-right: 15px;">Bienvenido</span>
                <button class="boton_cerrar_sesion" onclick="window.location.href='logout.php'">Cerrar Sesión</button>
                <?php else: ?>
                <button class="boton_iniciar_sesion" onclick="window.location.href='iniciar_sesion.php'">Iniciar
                    sesión</button>
                <button class="boton_registro" onclick="window.location.href='registro.php'">Registrate</button>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main>
        <h2>¿Quieres saber más de MAKA?👀</h2>

        <div class="contacto-mejorado">
            <div class="contacto-icono">
                <i class="fas fa-envelope-open-text"></i>
            </div>

            <div class="contacto-info-mejorada">
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div class="info-content">
                        <h3>Dirección</h3>
                        <p>Building Number: 19</p>
                        <p>McCowan Road, Woodside Square</p>
                        <p>Scarborough, Ontario M1S 3K1</p>
                    </div>
                </div>

                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <div class="info-content">
                        <h3>Correo Electrónico</h3>
                        <p>MAKA@gmail.com</p>
                    </div>
                </div>

                <div class="info-item">
                    <i class="fas fa-phone"></i>
                    <div class="info-content">
                        <h3>Teléfono</h3>
                        <p>+1 416 835</p>
                    </div>
                </div>

                <div class="info-item">
                    <i class="fas fa-clock"></i>
                    <div class="info-content">
                        <h3>Horarios de Consulta</h3>
                        <p>9:00 am - 5:00 pm</p>
                        <p>Lunes a Viernes</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="faq-container">
            <div class="acordeon">
                <h3>Respondemos tus dudas</h3>
                <div class="item">
                    <div class="pregunta">👍 ¿En qué te puede ayudar MAKA? <span>+</span></div>
                    <div class="respuesta">
                        <p>Te ayuda a manejar tus gastos y organizar tus ahorros de manera responsable.</p>
                    </div>
                </div>

                <div class="item">
                    <div class="pregunta">👌 ¿Cómo usar la calculadora de gastos? <span>+</span></div>
                    <div class="respuesta">
                        <p>El estudiante podrá ingresar su gasto o ingreso diario y cada semana se podrá actualizar esta
                            información.</p>
                    </div>
                </div>

                <div class="item">
                    <div class="pregunta">📱 ¿Qué pasa si se me olvida mi contraseña? <span>+</span></div>
                    <div class="respuesta">
                        <p>Al momento de registrarse se contestaron dos preguntas de seguridad para renovar su
                            contraseña en caso de olvidarla por lo cual deberá de entrar en la opción de "¿Olvidó la
                            contraseña?" y se mostrarán las preguntas de seguridad.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-section links-section">
                <h3>Links</h3>
                <ul class="footer-links">
                    <li><a href="inicio.php">Inicio</a></li>
                    <li><a href="maka.php">Calculadora digital</a></li>
                    <li><a href="que_somos.php">¿Que somos?</a></li>
                    <li><a href="contactanos.php">Contactanos</a></li>
                    <li><a href="sugerencias.php">Sugerencias</a></li>
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

    <script src="contactanos.js"></script>
</body>

</html>