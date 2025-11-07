<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAKA</title>
    <link rel="icon" type="icono" href="archivos/BANNER MAKA.gif">
    <link rel="stylesheet" href="inicio.css">
    <script src="https://kit.fontawesome.com/c80d489b0f.js" crossorigin="anonymous"></script>
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
                    <a href="maka.php">Calculadora de gastos</a>
                </div>
            </div>
            <a href="que_somos.php">¿Qué somos?</a>
            <a href="contactanos.php">Contáctanos</a>
            <a href="sugerencias.php">Sugerencias</a>
            <div class="boton">
                <button class="boton_iniciar_sesion" onclick="window.location.href='iniciar_sesion.php'">Iniciar
                    sesión</button>
                <button class="boton_registro" onclick="window.location.href='registro.php'">Registrate</button>
            </div>
        </div>
    </nav>


    <div class="gif-banner">
        <img src="archivos/BANNER MAKA.gif" alt="Banner MAKA">
    </div>

    <div class="contenido_texto">
        <h1>Tu dinero, tu control y tu futuro</h1>
        <p>
            Tu dinero tiene un propósito, y con MAKA puedes ver exactamente a dónde va. Analiza tus gastos por
            categorías y crea presupuestos. Es la herramienta perfecta para tomar el control de tu vida financiera.
        </p>
    </div>

    <div class="container">
        <section>
            <div class="section-content">
                <div class="section-icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <div class="section-text">
                    <h2>Gestiona tus gastos fácilmente</h2>
                    <p>Gestión de gastos fácil con <strong class="maka-text">MAKA</strong>. Registra, analiza y
                        categoriza cada uno de tus gastos, para que sepas en qué gastas tu dinero y puedas ahorrar.</p>
                </div>
            </div>
        </section>

        <section>
            <div class="section-content">
                <div class="section-icon">
                    <i class="fas fa-piggy-bank"></i>
                </div>
                <div class="section-text">
                    <h2>Ahorra para tus metas:</h2>
                    <p>Ya sea para un viaje, un nuevo portátil o simplemente para tener un colchón de seguridad, <strong
                            class="maka-text">MAKA</strong> te ayuda a alcanzar tus sueños. Crea metas de ahorro
                        personalizadas, sigue tu progreso y mantente motivado mientras construyes el futuro que deseas.
                    </p>
                </div>
            </div>
        </section>

        <section>
            <div class="section-content">
                <div class="section-icon">
                    <i class="fa-regular fa-user"></i>
                </div>
                <div class="section-text">
                    <h2>Divide cuentas sin estrés:</h2>
                    <p>Con <strong class="maka-text">MAKA</strong>, puedes organizar tus gastos individuales de forma
                        inteligente. Divide la cuenta de tus gastos en categorías como "alimentación", "universidad" o
                        "personal"; para que sepas en qué gastas tu dinero y puedas ajustarlo a tu presupuesto.</p>
                </div>
            </div>
        </section>
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