<?php
session_start();
$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAKA - ¿Qué somos?</title>
    <link rel="icon" type="icono" href="archivos/1.png">
    <link rel="stylesheet" href="que_somos.css">
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
    
    <div class="contenido-principal">
        <div class="contenido_texto">
            <h2>¿Que es MAKA? 🤔</h2>
            <p>
                MAKA es una plataforma que busca facilitar a los estudiantes con la gestion de su dinero. Su
                objetivo es poner al alcance de los usuarios una herramienta que permite llevar un control y
                calcular gastos e ingresos semanales y asi garantizar el uso adecuado de su presupuesto.
            </p>
        </div>
        
        <div class="container">
            <section>
                <div class="section-content">
                    <div class="section-text">
                        <h2>Vision 👀</h2>
                        <p>
                            Ser una plataforma lider en gestion de gastos para los estudiantes, brindando una herramienta de
                            calidad para su administracion. Ser reconocida por su accesibilidad y estetica.
                        </p>
                    </div>
                </div>
            </section>
            
            <section>
                <div class="section-content">
                    <div class="section-text">
                        <h2>Mision 📌</h2>
                        <p>
                            Fomentar a los estudiantes a formar un presupuesto y estar conscientes de sus gastos, asi
                            manteniendo un monitoreo constante de sus gastos y poder reducir la cantidad de gastos innecesarios.
                        </p>
                    </div>
                </div>
            </section>
            
            <section>
                <div class="section-content">
                    <div class="section-text">
                        <h2>Valores 🫱🏻‍🫲🏼</h2>
                        <ul>
                            <li>Servicio</li>
                            <li>Transparencia</li>
                            <li>Seguridad</li>
                            <li>Autocontrol</li>
                            <li>Responsabilidad</li>
                        </ul>
                    </div>
                </div>
            </section>
        </div>
        
        <hr class="linea-degradado">
        
        <div class="logo-2">
            <img src="archivos/1.png" alt="Logo MAKA">
        </div>
        
        <div class="contenido_texto">
            <h2>Orígenes de MAKA 🌱</h2>
            <p>
                El nombre <strong>MAKA</strong> viene del <strong>náhuatl</strong>, donde "ma" significa <em>mano</em> 
                y "ka" es <em>hacia</em>, representando <strong>"extender la mano hacia alguien"</strong>. 
                Esta esencia de apoyo define nuestra misión de guiar a los estudiantes en sus finanzas.
            </p>

            <p>
                <strong>MAKA</strong> también contiene las iniciales de nuestras fundadoras, 
                combinando herencia cultural con identidad personal.
            </p>

            <h3>✨ Tu Calculadora Financiera Estudiantil ✨</h3>

            <p>
                Diseñada específicamente para estudiantes, MAKA te permite registrar tus gastos e ingresos de forma sencilla 
                y visualizar tu progreso financiero con gráficos claros. Podrás seguir tu ahorro semanal, identificar gastos 
                innecesarios y planificar metas de ahorro realistas adaptadas a tu vida estudiantil.
            </p>
        </div>
    </div>

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
</body>
</html>