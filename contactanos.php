<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAKA</title>
    <link rel="icon" type="icono" href="archivos/1.png">
    <link rel="stylesheet" href="contactanos.css">
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

    <h2>¿Quieres saber más de MAKA?</h2>
    <div class="contacto-info">
        <div>
            <p>Dirección: Address 1: Building Number: 19 </p>
            <p>Street Name: McCowan Road</p>
            <p>Street Address: Woodside Squar</p>
            <p>State: Ontario</p>
            <p>City: Scarborough</p>
            <p>Postal Code: M1S 3K1</p>
        </div>
        <div class = "espaciador-uno">
            <p>Correo: maka@gmail.com</p>
        </div>

        <div>
            <p>Número de telefono: + 1 416 835</p>
            <p>Instagram: @somosmaka</p>
            <p>Horarios de consulta: 9:00 a 5:00 p.m. de Lunes a Viernes</p>
        </div>
    </div>
        <div class = "faq-container">
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
            <script src="contactanos.js"></script>
</body>

</html>