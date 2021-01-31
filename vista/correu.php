<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();


?>
<!doctype html>
<html lang="en-es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="assets/img/2.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Commissioner:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/css/styles.css">
    <link rel="icon" href="../styles/img/logoBotiga.png">
    <title>Send Email</title>
</head>
<body class="body-login">
<nav class="navbar navbar-expand-sm  navbar-light bg-light custom-navbar">
    <a href="../index.php" class="navbar-brand" style=" margin='10px'">
        <img src="../styles/img/logoBotiga.png"  height="50" alt="" /></a>

</nav>
<?php if(isset($_SESSION['correuNoTrobat'])) :?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error sending mail.</strong> There is not an account with this email.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
    unset($_SESSION['correuNoTrobat']);
elseif (isset($_SESSION['correuTrobat'])):?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Email sent successfuly.</strong> Check your email to change your account password.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif;
unset($_SESSION['correuTrobat']);
?>
<div class="main2">
    <p class="sign"  align="center"> Write the email associated <br> with your account. </p>
    <form method="post" class="form1" action="../controller/changePassword.php">
        <div class="div-inputs">
            <input class="correu " type="text" align="center" name="correu" placeholder="Email">
            <p></p>
        </div>
        <input class="submit" name="enviar" type="submit" align="center" value="Send Email">
    </form>
</div>

</body>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
