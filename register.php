<?php

// Requiere el codigo backend
require_once 'backend/register.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog Master - Registrate</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <!-- Estilos CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Livvic&display=swap" rel="stylesheet">
</head>
<body>

<!-- header de la pagina -->
<?php require 'header.php'; ?>

<main>
    <section id="contenedor">

        <?php if(isset($errors) || isset($success)) : ?>
            <div class="errors">
                <small><?php echo  $errors . $success; ?></small>
            </div>
        <?php endif; ?>
        
        <form class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="register">
            <h2>Registrate, es gratis</h2>
            <input type="text" name="name" placeholder="Nombre" value="<?php if(isset($_POST["name"])){echo $name;} ?>" required><br/>
            <input type="text" name="surname" placeholder="Apellidos" value="<?php if(isset($_POST["surname"])){echo $surname;} ?>" required><br/>
            <input type="email" name="email" placeholder="Correo electronico" value="<?php if(isset($_POST["email"])){echo $email;} ?>" required><br/>
            <input type="password" name="password" placeholder="Contrase&ntilde;a" required><br/>
            <input type="password" name="password2" placeholder="Repite la Contrase&ntilde;a" required><br/>
            <!-- Fecha de nacimiento -->
            <label for="fecha">Fecha de Nacimiento</label><br/>
            <!-- Dia de nacimiento -->
            <select name="day" id="fecha">
                <?php 
                    for($d=1; $d<=31; $d++){
                        echo "<option value='$d' selected>$d</option>";
                    }
                ?>
            </select>
            <!-- Anio de nacimiento -->
            <select name="mes" id="mes">
                <option value="enero" selected>Enero</option>
                <option value="febrero">Febrero</option>
                <option value="marzo">Marzo</option>
                <option value="abril">Abril</option>
                <option value="mayo">Mayo</option>
                <option value="junio">Junio</option>
                <option value="julio">Julio</option>
                <option value="agosto">Agosto</option>
                <option value="septiembre">Septiembre</option>
                <option value="octubre">Octubre</option>
                <option value="noviembre">Noviembre</option>
                <option value="diciembre">Diciembre</option>
            </select>
            <!-- Mes de nacimiento -->
            <select name="anio" id="anio">
                <?php 
                    for($a=1950; $a<=2010; $a++){
                        echo "<option value='$a' selected>$a</option>";
                    }
                ?>
            </select><br/>
            <!-- Femenino o masculino -->
                <label for="hombre">Hombre</label>
                <input type="radio" name="sexo" id="hombre" value="masculino" checked>

                <label for="mujer">Mujer</label>
                <input type="radio" name="sexo" id="mujer" value="femenina"><br/>
                <label for="message">Describe como eres:</label><br/>
                <textarea name="message" id="message" placeholder="A&ntilde;ade una descripción a tu usuario"><?php if(isset($_POST['message'])){echo $message;} ?></textarea>
            <button type="submit" name="entrar" name="submit">Registrate</button>
            <p>¿Ya estas registrado ?</p>
            <p><a href="index.php">Inicia Sesion</a></p>
        </form>
    </section>
</main>

<!-- Footer de la pagina -->
<?php require 'footer.php'; ?>

<!-- Jquery -->
<!-- <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script> -->

<!-- MainJS -->
<!-- <script src="js/main.js"></script> -->
    
</body>
</html>