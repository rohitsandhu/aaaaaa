<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../classes/Conexio.php";
include "../classes/Usuari.php";

$con = new Conexio();
session_start();



?>
<!doctype html>
<html lang="en-es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Commissioner:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/css/styles.css">
    <link rel="icon" href="../styles/img/logoBotiga.png">

    <title>Log In</title>
</head>
<body class="body-login">
<nav class="navbar navbar-expand-sm  navbar-light bg-light custom-navbar" style="background-color: rgba(242, 241, 241,0.9)!important;">
    <a href="../index.php" class="navbar-brand" style=" margin='10px'">
        <img src="../styles/img/logoBotiga.png"  height="50" alt="" /></a>

</nav>
    <?php if(isset($_SESSION['recordatori'])) :?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error logging in.</strong> Some input might no be correct o not filled.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif;
    unset($_SESSION['recordatori']);
    ?>

<?php if(isset($_SESSION['noPotComprar'])) :?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error</strong> You can't buy products or add products to the cart without logging in first.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif;
unset($_SESSION['noPotComprar']);
?>

<div class="main2">
    <p class="sign" action="login.php" align="center">Iniciar Secció</p>
    <form method="post" class="form1" action="../controller/loginController.php">
        <div class="div-inputs">
            <input class="correu " type="text" align="center" name="correu" placeholder="Correu">
            <p></p>
        </div>
        <div class="div-inputs">
            <input class="contra" type="password" align="center" name="contrasenya" placeholder="Contrasenya">
            <p></p>
        </div>

            <input class="submit" name="enviar" type="submit" align="center" value="Sign in"></input>
        <br>
        <br>
        <a class="custom-link" href="register.php"> You don't have an account? Click here.</a>
        <br>
        <a class="custom-link" href="correu.php"> You don't remember the password? Click here.</a>
    </form>
</div>

</body>
                    <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>