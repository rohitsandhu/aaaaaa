<?php
include '../classes/Usuari.php';
include '../classes/Conexio.php';
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!isset($_SESSION['usuariLogged'])){
    header('Location: ../index.php');
}

$_SESSION['nom'] = $_SESSION['nom'] ?? "";
$_SESSION['cognoms'] = $_SESSION['cognoms'] ?? "";
$_SESSION['dni'] = $_SESSION['dni'] ?? "";
$_SESSION['adreça'] = $_SESSION['adreça'] ?? "";

$_SESSION['nomErr'] = $_SESSION['nomErr'] ?? "";
$_SESSION['cognomsErr'] = $_SESSION['cognomsErr'] ?? "";
$_SESSION['dniErr'] = $_SESSION['dniErr'] ?? "";
$_SESSION['adreçaErr'] = $_SESSION['adreçaErr'] ?? "";


?>
<!doctype html>
<html lang="en-es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet"
          type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="icon" href="../styles/img/logoBotiga.png">
    <link rel="stylesheet" href="../styles/css/styles.css">
    <title>Profile</title>
</head>
<body class="body2">
<nav class="navbar navbar-expand-sm  navbar-light bg-light">
    <a href="../index.php" class="navbar-brand" style=" margin='10px'">
        <img src="../styles/img/logoBotiga.png"  height="50" alt="" /></a>
    <li class="nav-item dropdown ml-auto">
        <a class="btn-light btn" href="../index.php?logout=true"> Log Out </a>
    </li>
</nav>
<?php if(isset($_SESSION['correuNoTrobat'])) :?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error sending mail.</strong> There is not an account with this email so we can't change the password.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
    unset($_SESSION['correuNoTrobat']);
elseif (isset($_SESSION['correuTrobat'])):?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Email sent successfuly.</strong> Check your email to change your accounts password.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif;
unset($_SESSION['correuTrobat']);
?>


<?php if(isset($_SESSION['elCorreuJaExisteix'])) :?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Can't change email.</strong> There is already an account with this email.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
    unset($_SESSION['elCorreuJaExisteix']);
elseif (isset($_SESSION['correuEnviarPerCanviarMail'])):?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Email changed successfuly.</strong> Check your email to verify your account.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php unset($_SESSION['correuEnviarPerCanviarMail']);

elseif (isset($_SESSION['correuFormatDolent'])):?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Can't change Email.</strong> The new email format is wrong.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php unset($_SESSION['correuFormatDolent']); endif;?>

<?php if(isset($_SESSION['dadesCanviadesCorrectament'])) :?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Changes have been made successfully.</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
    unset($_SESSION['dadesCanviadesCorrectament']);
elseif (isset($_SESSION['fDades'])):?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error changing data.</strong>

        <?php
        if(isset($_SESSION['nomErr'])){
            echo $_SESSION['nomErr'].'<br>';
        }
        if(isset($_SESSION['cognomsErr'])){
            echo $_SESSION['cognomsErr'].'<br>';
        }
        if(isset($_SESSION['dniErr'])){
            echo $_SESSION['dniErr'].'<br>';
        }
        if(isset($_SESSION['adreçaErr'])){
            echo $_SESSION['adreçaErr'];
        }
        ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif;
unset($_SESSION['fDades']);
?>
<div class="container emp-profile">
    <form method="post" action="../controller/controllerCanviarDades.php">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="https://i.pinimg.com/originals/0c/3b/3a/0c3b3adb1a7530892e55ef36d3be6cb8.png" alt=""/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h5>
                        <?php echo $_SESSION['usuariLogged']->getNom()." ". $_SESSION['usuariLogged']->getCognoms();?>
                    </h5>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                <input type="submit" class="btn btn-light mb-2" name="enviar" value="SAVE">
                <a href="perfil.php" class="btn btn-light" name="btnAddMore"> CANCEL </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="profile-work">

                </div>
            </div>
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <label>User Id</label>
                            </div>
                            <div class="col-md-6">
                                <label value="<?php echo $_SESSION['usuariLogged']->getIdUsuari(); ?>" name="idUsuari"> <?php echo $_SESSION['usuariLogged']->getIdUsuari(); ?> </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Name</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="nom" name="nom" value="<?php
                                if( $_SESSION['nom']==""){
                                    echo $_SESSION['usuariLogged']->getNom();
                                }else{
                                    echo $_SESSION['nom'];
                                }?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Surname</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="cognoms" id="cognoms" value="<?php
                                if( $_SESSION['cognoms']==""){
                                    echo $_SESSION['usuariLogged']->getCognoms();
                                }else{
                                    echo $_SESSION['cognoms'];
                                }?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>DNI</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="dni" id="dni" value="<?php
                                    if($_SESSION['usuariLogged']->getDni()==""){
                                        echo "Not Specified";
                                    }else {
                                        if ($_SESSION['dni'] == "") {
                                            echo $_SESSION['usuariLogged']->getDni();
                                        } else {
                                            echo $_SESSION['dni'];
                                        }
                                    }?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Adress</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="adreça" id="adreça" value="<?php
                                if($_SESSION['usuariLogged']->getAdreça()==""){
                                    echo "Not Specified";
                                }else {
                                    if( $_SESSION['adreça']==""){
                                        echo $_SESSION['usuariLogged']->getAdreça();
                                    }else{
                                        echo $_SESSION['adreça'];
                                    }
                                }?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="container emp-profile">
    <form method="post" action="../controller/newMailController.php">
            <div class="mb-4">
                <h4 class="mb-2"> Change Email </h4>
                <p>* We will email you to verify your new email(Only when you accept the verification we will change the current account email) *</p>
            </div>
                <h6 class="mb-2"> Current Account Email</h6>
                <input type="text" class="form-control mb-4" disabled value="<?php echo $_SESSION['usuariLogged']->getCorreu();?>" name="newMail">
            <h6 class="mb-2"> New Account Email</h6>
            <input type="hidden" name="correuHidden" value="<?php echo $_SESSION['usuariLogged']->getCorreu();?>">
            <input type="text" class="form-control mb-3" name="newMail">
        <input class="btn btn-light"  name="enviar" type="submit" value="Send Email">
    </form>
</div>




<div class="container emp-profile">
    <form method="post" action="../controller/changePassword.php" >
            <div class="mb-4">
                <h4 class="mb-2"> Change Password </h4>
                <p>* We will email you to reset your password *</p>
            </div>
            <div class="input-group">

                <input type="text" class="form-control" disabled value="<?php echo $_SESSION['usuariLogged']->getCorreu();?>" name="correu">
                <input type="hidden" value="<?php echo $_SESSION['usuariLogged']->getCorreu();?>" name="correuHidden">
                <input class="btn btn-light"  name="enviar" type="submit" value="Send Email">
            </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>