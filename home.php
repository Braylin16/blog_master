<?php session_start();

// Comprobar si el usuario ha inciado sesion
if(empty($_SESSION['email'])){
    header('Location: index.php');
}

require_once 'conexion.php';

$email = $_SESSION['email'];

// Sacar el nombre de la persona que ha iniciado sesion
$stmt = $conexion->query("SELECT * FROM users WHERE email = '$email'");
$stmt->execute(['email' => $email]);
while ($row = $stmt->fetch()) {
    $name = $row['name'];
    $surname = $row['surname'];
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog Master</title>
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
            <h3>Bienvenido: <?php echo $name . " " . $surname; ?></h3>
            <p class="parrafo">Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
            Rerum non repudiandae nisi quasi laudantium corrupti animi. Sint neque expedita 
            a voluptatum culpa, distinctio consectetur saepe voluptas aliquid impedit sed veritatis?</p>

            <p class="parrafo">Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
            Rerum non repudiandae nisi quasi laudantium corrupti animi. Sint neque expedita 
            a voluptatum culpa, distinctio consectetur saepe voluptas aliquid impedit sed veritatis?</p>

            <p class="parrafo">Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
            Rerum non repudiandae nisi quasi laudantium corrupti animi. Sint neque expedita 
            a voluptatum culpa, distinctio consectetur saepe voluptas aliquid impedit sed veritatis?</p>

            <p class="parrafo">Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
            Rerum non repudiandae nisi quasi laudantium corrupti animi. Sint neque expedita 
            a voluptatum culpa, distinctio consectetur saepe voluptas aliquid impedit sed veritatis?</p>

            <p class="parrafo">Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
            Rerum non repudiandae nisi quasi laudantium corrupti animi. Sint neque expedita 
            a voluptatum culpa, distinctio consectetur saepe voluptas aliquid impedit sed veritatis?</p>
        </article>
    </section>
</main>

<!-- Footer de la pagina -->
<?php require 'footer.php'; ?>
    
</body>
</html>