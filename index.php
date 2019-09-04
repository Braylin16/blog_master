<?php

require_once 'backend/login.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog Master - Inicia Sesion</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <!-- Estilos CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Livvic&display=swap" rel="stylesheet">
</head>

<!-- Header de la pagina -->
<body>
<?php require 'header.php'; ?>
<main>
    <section id="contenedor">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="login">
            <h2>Inicia Sesion</h2>
            <input type="text" name="email" placeholder="Correo electronico" value="<?php if(isset($_POST['email'])){echo $email;}?>" required><br/>
            <input type="password" name="password" placeholder="Contrase&ntilde;a" required><br/>
            <button type="submit" name="entrar">Entrar</button>

            <p class="inicio_error"><?php if(isset($errors)){echo $errors;}?></p>

            <p>¿Aun no tienes cuenta ?</p>
            <p><a href="register.php">Registrate</a></p>
        </form>
    </section>
</main>

<!-- Footer de la pagina -->
<?php require 'footer.php'; ?>
    
</body>
</html>