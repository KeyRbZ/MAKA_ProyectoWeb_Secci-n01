<?php
session_start();

if (empty($_SESSION['csrf'])) {
  $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

$success = $error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if (!isset($_POST['csrf']) || !hash_equals($_SESSION['csrf'], $_SESSION['csrf'])) {
    $error = 'Sesión inválida. Recarga e inténtalo de nuevo.';
  } else {

    $nombre   = trim($_POST['nombre']   ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $email    = trim($_POST['email']    ?? '');
    $detalle  = trim($_POST['detalle']  ?? ''); 

    $errs = [];
    if (mb_strlen($nombre)   < 2 || mb_strlen($nombre)   > 80)  $errs[] = 'Nombre inválido.';
    if (mb_strlen($apellido) < 2 || mb_strlen($apellido) > 80)  $errs[] = 'Apellido inválido.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))             $errs[] = 'Email inválido.';
    if (mb_strlen($detalle)  < 10)                               $errs[] = 'Detalle demasiado corto.';

    if ($errs) {
      $error = implode(' ', $errs);
    } else {
      $success = '¡Gracias! Recibimos tu sugerencia y la estamos canalizando.';
      $_POST = [];
    }
  }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAKA</title>
    <link rel="icon" type="icono" href="archivos/1.png">
    <link rel="stylesheet" href="sugerencias.css">
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
    <form class="sugerencias-form" method="POST" action="">
  <input type="hidden" name="csrf" value="<?php echo htmlspecialchars($_SESSION['csrf']); ?>">

  <?php if (isset($success)): ?>
    <div class="alert success"><?php echo $success; ?></div>
  <?php endif; ?>
  <?php if (isset($error)): ?>
    <div class="alert error"><?php echo $error; ?></div>
  <?php endif; ?>

  <div class="form-row">
    <div class="form-group">
      <label for="nombre">Nombre*</label>
      <input type="text" id="nombre" name="nombre" autocomplete="given-name" required
             value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>">
    </div>

    <div class="form-group">
      <label for="apellido">Apellido*</label>
      <input type="text" id="apellido" name="apellido" autocomplete="family-name" required
             value="<?php echo isset($_POST['apellido']) ? htmlspecialchars($_POST['apellido']) : ''; ?>">
    </div>
  </div>

  <div class="form-section">
    <h3>Email*</h3>
    <div class="form-group">
      <input type="email" id="email" name="email" autocomplete="email" required
             placeholder="Ingrese su correo electrónico"
             value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
    </div>
  </div>

  <div class="form-section">
    <h3>Detalle su problema*</h3>
    <div class="form-group">
      <textarea id="detalle" name="detalle" rows="5" required
        placeholder="Describa su sugerencia o incidencia"><?php
          echo isset($_POST['detalle']) ? htmlspecialchars($_POST['detalle']) : '';
        ?></textarea>
    </div>
  </div>

  <button type="submit" class="btn-primario">Enviar</button>
</form>
  
</body>

</html>