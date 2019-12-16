<?php session_start();

require_once 'conexion.php';

// Comprobar si el usuario ha inciado sesion
if(isset($_SESSION['email'])){
    header('Location: home.php');
}

// Mensajes
$errors = "";
$success = "";

if(isset($_POST['name']) and isset($_POST['surname']) and isset($_POST['email']) and isset($_POST['password'])
 and isset($_POST['password2']) and isset($_POST['day']) and isset($_POST['mes']) and isset($_POST['anio'])
 and isset($_POST['sexo']) and isset($_POST['message'])){

    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];
    $day = $_POST["day"];
    $mes = $_POST["mes"];
    $anio = $_POST["anio"];
    $sexo = $_POST["sexo"];
    $message = $_POST['message'];

    // Cifrar la password
    $password = hash('sha512', $password);
    $password2 = hash('sha512', $password2);

    // Validar que las password coincidan
    if($password != $password2){
        $errors = "* La contraseña no coinciden <br />";
    }

    // Validar datos
    if(empty($_POST['name'])){
        $errors .= "* Cual es tu nombre ? <br />";
    }

    if(empty($_POST['surname'])){
        $errors .= "* Cuales son tus apellidos ? <br />";
    }

    if(empty($_POST['email'])){
        $errors .= "* El correo electronico no puede estar vacio <br />";
    }

    if(empty($_POST['password'])){
        $errors .= "* Elige una contraseña que sea segura <br />";
    }

    if(empty($_POST['password2'])){
        $errors .= "* Tienes que confirmar tu contraseña <br />";
    }

    if(empty($_POST['day']) and empty($_POST['mes']) && empty($_POST['anio'])){
        $errors .= "* Cuando naciste ? <br />";
    }

    if(empty($_POST['sexo'])){
        $errors .= "* Elige tu sexo <br />";
    }

    if(empty($_POST['message'])){
        $errors .= "* Debes a&ntilde;adir una descripción a tu biografia";
    }

    // Convertir a mayusculas las primeras letras de cada palabra
    $name = ucwords($name);
    $surname = ucwords($surname);

    // Limpiar y validar los datos que nos llegan
    $name = htmlspecialchars($name);
    $name = trim($name);
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $surname = htmlspecialchars($surname);
    $surname = trim($surname);
    $surname = filter_var($surname, FILTER_SANITIZE_STRING);

    $email = htmlspecialchars($email);
    $email = trim($email);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    $password = htmlspecialchars($password);
    $password = trim($password);

    $password2 = htmlspecialchars($password2);
    $password2 = trim($password2);

    $message = htmlspecialchars($message);
    $message = trim($message);
    $message = filter_var($message, FILTER_SANITIZE_STRING);

    // Validar la cantidad de carateres MAXIMO
    $maximoName = strlen($name);
    if($maximoName <= 15){

    } else {
        $errors .= "* El nombre no debe tener mas de 15 carateres <br/>";
    }

    $maximoSurname = strlen($surname);
    if($maximoSurname <= 20){

    } else {
        $errors .= "* El Apellido no debe tener mas de 20 carateres <br/>";
    }

    // Validar la cantidad de carateres MINIMO
    $minimoName = strlen($name);
    if($minimoName >= 3){

    } else {
        $errors .= "* El nombre debe tener minimo 3 carateres <br/>";
    }

    $minimoSurname = strlen($surname);
    if($minimoSurname >= 4){

    } else {
        $errors .= "* El Apellido debe tener minimo 4 carateres <br/>";
    }

    // Validar que el correo electronico sea valido
    if($email == false){
        $errors .= "* Esto no es un correo electronico";
    }
    
    // Validar que el usuario no exista en la base de datos
    $sentencia = $conexion->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");

    $sentencia->execute(array(
        ':email' => $email
    ));

    $resultado = $sentencia->fetch();

    // Comprobar que el email no sea repetido
    if($resultado != false){
        $errors .= "* Este correo electronico ya existe, prueba otro";
    }

    if($errors == ''){
        $statement = $conexion->prepare('INSERT INTO users (id, name, surname, email, password, day, mes, anio, sexo, message) VALUES(
            null, :name, :surname, :email, :password, :day, :mes, :anio, :sexo, :message)'
        );
        $statement->execute(array(
            ':name' => $name,
            ':surname' => $surname,
            ':email' => $email,
            ':password' => $password,
            ':day' => $day,
            ':mes' => $mes,
            ':anio' => $anio,
            ':sexo' => $sexo,
            ':message' => $message
        ));

        $success = "Te has registrado con exito";
        header("Refresh:2; url=index.php");
    }
}
?>