<?php
include 'conexion.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        

        if (password_verify($password, $usuario['password'])) {

            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $_SESSION['usuario_email'] = $usuario['email'];
            
            $success = "¡Inicio de sesión exitoso!";

            header("Refresh: 2; url=inicio.php");
        } else {
            $error = "Contraseña incorrecta";
        }
    } else {
        $error = "Usuario no encontrado";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAKA - Iniciar Sesión</title>
    <link rel="icon" type="icono" href="archivos/1.png">
    <link rel="stylesheet" href="registro.css">
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
                <button class="boton_iniciar_sesion" onclick="window.location.href='iniciar_sesion.php'">Iniciar
                    sesión</button>
                <button class="boton_registro" onclick="window.location.href='registro.php'">Registrate</button>
            </div>
        </div>
    </nav>

    <div class="form-container">
        <h2>Iniciar Sesión</h2>
        <p>Ingresa tus credenciales para acceder a tu cuenta</p>

        <form class="register-form" method="POST" action="">
            <!-- Mensajes de éxito/error -->
            <?php if (isset($success)): ?>
            <div class="alert success">
                <?php echo $success; ?>
            </div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
            <div class="alert error">
                <?php echo $error; ?>
            </div>
            <?php endif; ?>

            <div class="form-section">
                <h3>Email*</h3>
                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="Ingrese su correo electrónico"
                        value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
                </div>
            </div>

            <div class="form-section">
                <h3>Contraseña*</h3>
                <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required>
                </div>
            </div>

            <button type="submit" class="btn-create-account">Iniciar Sesión</button>
        </form>
        <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
    </div>
</body>
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

</html>