<?php session_start();

// Comprobar si el usuario ha inciado sesion
if(empty($_SESSION['email'])){
    header('Location: index.php');
}

require_once 'backend/edit.php';

$email = $_SESSION['email'];

// Sacar el nombre de la persona que ha iniciado sesion
$stmt = $conexion->query("SELECT * FROM users WHERE email = '$email'");
$stmt->execute(['email' => $email]);
while ($row = $stmt->fetch()) {
    $name = $row['name'];
    $surname = $row['surname'];
    $message = $row['message'];
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog Master | Edita tu biografia</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <!-- Estilos CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Livvic&display=swap" rel="stylesheet">
</head>
<body>

<!-- Header de la pagina -->
<?php require 'header.php'; ?>

<main>
    <section id="contenedor">
    <a href="cerrar.php" class="salir">Cerrar Sesion</a>
        <article>
            <h3>Describe tus gustos o algo más...</h3>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <textarea name="message" id="formEdit" placeholder="<?php echo $name; ?>, edita tu biografia"><?php echo $message; ?></textarea>

                <!-- Mensaje de error o exito -->
                <?php if(isset($success) || isset($errors)) : ?>
                    <p class="verde"><?php echo $success; ?></p>
                    <p class="rojo"><?php echo $errors; ?></p>
                <?php endif ?>

                <button class="login" name="edit" type="submit">Editar</button>
            </form>

            <br/>
            <hr/>
            <p><a href="home.php">Volver</a></p>
        </article>
    </section>
</main>

<!-- Footer de la pagina -->
<?php require 'footer.php'; ?>
    
</body>
</html>