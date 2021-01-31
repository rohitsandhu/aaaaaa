<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../classes/Conexio.php";
include "../classes/Usuari.php";
ob_start();
session_start();
$con = new Conexio();

$idUsuari = $_GET['idUsuari'] ?? "";
$token = $_GET['token'] ?? "";

$_SESSION['idUsuari'] = $_SESSION['idUsuari'] ?? $idUsuari;
$_SESSION['token'] = $_SESSION['token'] ?? $token;

if (isset($_GET['canviarContra'])){

    if($_POST['contra1']==$_POST['contra2'] && $_POST['contra2']!=""){

        $con->openConnection();
        $con->changePassword($_POST['contra1'],$_POST['idUsuari'], $_SESSION['token']);

        $_SESSION['contraCanviada'] = "text";
        $_SESSION['usuariLogged'] = $con->getUsuariById($_POST['idUsuari']);
        $con->closeConnection();
        header('Location: ../index.php');
    }else{
        $_SESSION['errorContra'] = "text";
//        header('Location: password.php');
    }
}
?>
<!doctype html>
<html lang="en-es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<!--    <link rel="icon" href="assets/img/2.png">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Commissioner:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/css/styles.css">
    <link rel="icon" href="../styles/img/logoBotiga.png">
    <title>Reset Password</title>
</head>
<body class="body-login">
<nav class="navbar navbar-expand-sm  navbar-light bg-light custom-navbar">
    <a href="../index.php" class="navbar-brand" style=" margin='10px'">
        <img src="../styles/img/logoBotiga.png"  height="50" alt="" /></a>
</nav>
<?php if(isset($_SESSION['errorContra'])):?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error changing password.</strong> The password didn't mached or some input was empty, Retry it please.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php unset($_SESSION['errorContra']); endif; ?>

<div class="main6">
    <form method="post" class="form1" action="password.php?canviarContra=true">

        <div style="margin-left: 120px">
            <h5> New Password </h5>
        </div>
        <div class="div-inputs">
            <input type="hidden" name="idUsuari" value="<?php echo $_SESSION['idUsuari']; ?>">
            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
            <input class="contra" type="password" align="center" name="contra1" placeholder="Password 1">
            <p></p>
        </div>
        <div class="div-inputs">
            <input class="contra2" type="password" align="center" name="contra2" placeholder="Password 2">
            <p></p>
        </div>
        <input class="submit" name="enviar2" type="submit" align="center" value="Set Password">
        <br>
        <br>
    </form>
</div>
</body>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>