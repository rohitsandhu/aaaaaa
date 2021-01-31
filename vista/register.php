<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../classes/Conexio.php';
include '../classes/Usuari.php';


if (isset($_GET['error'])){
    $_SESSION['correu'] = $_SESSION['correu'] ?? "";
    $_SESSION['nom'] = $_SESSION['nom'] ?? "";
    $_SESSION['cognoms'] = $_SESSION['cognoms'] ?? "";
    $_SESSION['contra2'] = $_SESSION['contra2'] ?? "";
    $_SESSION['contra'] = $_SESSION['contra'] ?? "";

    $_SESSION['correuErr'] = $_SESSION['correuErr'] ?? "";
    $_SESSION['nomErr'] = $_SESSION['nomErr'] ?? "";
    $_SESSION['cognomsErr'] = $_SESSION['cognomsErr'] ?? "";
    $_SESSION['contra2Err'] = $_SESSION['contra2Err'] ?? "";
    $_SESSION['contraErr'] = $_SESSION['contraErr'] ?? "";
    $_SESSION['recaptchaErr'] = $_SESSION['recaptchaErr'] ?? "";
}else{
    $_SESSION['correuErr'] = "";
    $_SESSION['nomErr'] = "";
    $_SESSION['cognomsErr'] = "";
    $_SESSION['contra2Err'] = "";
    $_SESSION['contraErr'] = "";
    $_SESSION['recaptchaErr'] = "";
}

?>

<!doctype html>
<html lang="en-es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../styles/img/logoBotiga.png">
    <link rel="stylesheet" href="../styles/css/styles.css">
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
</head>
<body class="body4">

<nav class="navbar navbar-expand-sm  navbar-light bg-light custom-navbar">
    <a href="../index.php" class="navbar-brand" style=" margin='10px'">
        <img src="../styles/img/logoBotiga.png"  height="50" alt="" /></a>

</nav>

<div class="main">
    <p class="sign" align="center">Register</p>
    <form method="post" class="form1" action="../controller/registerController.php?comprovarRegister=true">

        <div class="div-inputs">
            <input class="nom" name="nom" type="text" align="center" placeholder="Nom"
                   value="<?php echo $_SESSION['nom'] ?? ''?>">
            <p class="error"> <?php echo $_SESSION['nomErr'];?></p>
        </div>

        <div class="div-inputs">
            <input class="cognoms" name="cognoms" type="text" align="center" placeholder="Cognoms"
                   value="<?php echo $_SESSION['cognoms'] ?? ''?>">
            <p class="error"> <?php echo $_SESSION['cognomsErr'];?></p>
        </div>

        <div class="div-inputs">
            <input class="correu" name="correu" type="text" align="center" placeholder="Correu"
                value="<?php echo $_SESSION['correu'] ?? ''?>">
            <p class="error"> <?php echo $_SESSION['correuErr'];?></p>
        </div>

        <div class="div-inputs">
            <input class="contra" name="contra" type="password" align="center" placeholder="Contrasenya"
                   value="<?php echo $_SESSION['contra'] ?? ''?>">
            <p class="error"> <?php echo $_SESSION['contraErr'];?></p>
        </div>

        <div class="div-inputs">
            <input class="contra2" name="contra2" type="password" align="center" placeholder="Repetir contrasenya"
                   value="<?php echo $_SESSION['contra2'] ?? ''?>">
            <p class="error"> <?php echo $_SESSION['contra2Err'];?></p>
        </div>

        <div class="div-inputs">
            <div class="g-recaptcha ml-5 mt-1 mb-2" data-sitekey="6LfUzOQZAAAAADRahaaE5xF1S9hfNZQAmxWTgQKj"></div>
            <p class="error"> <?php echo $_SESSION['recaptchaErr'];?></p>
        </div>
        <input class="submit mt-2" name="enviar" type="submit" align="center" value="Sign Up">
        <br>
        <br>
        <a class="custom-link" style="margin-left: 17% " href="login.php"> Already have an account? Click here.</a>
    </form>
</div>


</body>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
