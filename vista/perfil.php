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
    <nav class="navbar navbar-expand-sm  navbar-light bg-light custom-navbar">
        <a href="../index.php" class="navbar-brand" style=" margin='10px'">
            <img src="../styles/img/logoBotiga.png"  height="50" alt="" /></a>

        <li class="nav-item mr-auto">
            <a class="btn-light btn"   href="../vista/paginaFacturas.php"> Orders </a>
        </li>
        <li class="nav-item ml-auto">
            <a class="btn-light btn" href="../index.php?logout=true"> Log Out </a>
        </li>
    </nav>

    <div class="container emp-profile">
        <form method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img src="https://i.pinimg.com/originals/0c/3b/3a/0c3b3adb1a7530892e55ef36d3be6cb8.png" alt=""/>

                            <?php if ($_SESSION['usuariLogged']->getActivat()==0):?>
                        <div class="file btn btn-lg btn-primary" style="background-color: rgba(219, 58, 18,0.8);">
                                UNVERIFIED
                        </div>
                            <?php else:?>
                        <div class="file btn btn-lg btn-primary" style="background-color: rgba(0, 184, 37,0.8);">
                                VERIFIED
                        </div>
                            <?php endif; ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h5>
<!--                            --><?php //echo $_SESSION['usuariLogged']->getNom()." ". $_SESSION['usuariLogged']->getCognoms();?>
                        </h5>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active xddd" id="home-tab" data-toggle="tab" role="tab" aria-controls="home" aria-selected="true">About</a>
                            </li>
<!--                            <li class="nav-item">-->
<!--                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>-->
<!--                            </li>-->
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="canviarDades.php" class="btn btn-light" name="btnAddMore"> Edit Profile </a>
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
                                    <p> <?php echo $_SESSION['usuariLogged']->getIdUsuari(); ?> </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Full name</label>
                                </div>
                                <div class="col-md-6">
                                    <p><?php echo $_SESSION['usuariLogged']->getNom()." ". $_SESSION['usuariLogged']->getCognoms();?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <p><?php echo $_SESSION['usuariLogged']->getCorreu(); ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>DNI</label>
                                </div>
                                <div class="col-md-6">
                                    <p><?php
                                        if($_SESSION['usuariLogged']->getDni()==""){
                                            echo "Not Specified";
                                        }else {
                                            echo $_SESSION['usuariLogged']->getDni();
                                        }?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Adress</label>
                                </div>
                                <div class="col-md-6">
                                    <p><?php
                                       if($_SESSION['usuariLogged']->getAdreça()==""){
                                           echo "Not Specified";
                                       }else {
                                           echo $_SESSION['usuariLogged']->getAdreça();
                                       }?></p>
                                </div>
                            </div>
                        </div>

<!--                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">-->
<!--                            <div class="row">-->
<!--                                <div class="col-md-6">-->
<!--                                    <label>Experience</label>-->
<!--                                </div>-->
<!--                                <div class="col-md-6">-->
<!--                                    <p>Expert</p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="row">-->
<!--                                <div class="col-md-6">-->
<!--                                    <label>Hourly Rate</label>-->
<!--                                </div>-->
<!--                                <div class="col-md-6">-->
<!--                                    <p>10$/hr</p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="row">-->
<!--                                <div class="col-md-6">-->
<!--                                    <label>Total Projects</label>-->
<!--                                </div>-->
<!--                                <div class="col-md-6">-->
<!--                                    <p>230</p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="row">-->
<!--                                <div class="col-md-6">-->
<!--                                    <label>English Level</label>-->
<!--                                </div>-->
<!--                                <div class="col-md-6">-->
<!--                                    <p>Expert</p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="row">-->
<!--                                <div class="col-md-6">-->
<!--                                    <label>Availability</label>-->
<!--                                </div>-->
<!--                                <div class="col-md-6">-->
<!--                                    <p>6 months</p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="row">-->
<!--                                <div class="col-md-12">-->
<!--                                    <label>Your Bio</label><br/>-->
<!--                                    <p>Your detail description</p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                    </div>
                </div>
            </div>
        </form>
    </div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

