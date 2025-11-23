<?php
include 'conexion.php';
session_start();
$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $password = $_POST['password'];
    

    if ($_POST['password'] !== $_POST['confirm_password']) {
        $error = "Las contraseñas no coinciden";
    } else {

        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        

        $sql = "INSERT INTO usuarios (nombre, apellido, email, telefono, password) 
                VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sssss", $nombre, $apellido, $email, $telefono, $password_hash);
        
        if ($stmt->execute()) {
            $success = "¡Usuario registrado exitosamente!";
            $_POST = array();
        } else {
            $error = "Error al registrar: " . $conexion->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAKA - Registro</title>
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

    <div class="form-container">
        <h2>Crear una cuenta</h2>
        <p>Agregar en los campos requeridos la información a registrar para obtener una cuenta en MAKA</p>

        <form class="register-form" method="POST" action="">
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

            <div class="form-row">
                <div class="form-group">
                    <label for="nombre">Nombre*</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre"
                        value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>" required>
                </div>

                <div class="form-group">
                    <label for="apellido">Apellido*</label>
                    <input type="text" id="apellido" name="apellido" placeholder="Ingrese su apellido"
                        value="<?php echo isset($_POST['apellido']) ? $_POST['apellido'] : ''; ?>" required>
                </div>
            </div>

            <div class="form-section">
                <h3>Email*</h3>
                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="Ingrese su correo electrónico"
                        value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
                </div>
            </div>

            <div class="form-section">
                <h3>Numero telefónico*</h3>
                <div class="form-group">
                    <input type="tel" id="telefono" name="telefono" placeholder="Ingrese su numero de teléfono"
                        value="<?php echo isset($_POST['telefono']) ? $_POST['telefono'] : ''; ?>" required>
                </div>
            </div>

            <div class="form-section">
                <h3>Cree su contraseña*</h3>
                <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="Cree una contraseña" required>
                </div>
            </div>

            <div class="form-section">
                <h3>Confirme su contraseña*</h3>
                <div class="form-group">
                    <input type="password" id="confirm_password" name="confirm_password"
                        placeholder="Reescriba su contraseña" required>
                </div>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" id="terminos" name="terminos" required>
                <label for="terminos">Acepta los términos y servicio y Política de privacidad.</label>
            </div>

            <button type="submit" class="btn-create-account">Crear cuenta</button>
        </form>
        <p>¿Ya tienes tu cuenta? <a href="iniciar_sesion.php" class="login-link">Inicia sesión</a></p>
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