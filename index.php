<?php
include 'classes/Usuari.php';
session_start();
if(isset($_GET['logout'])){
    unset($_SESSION['usuariLogged']);
}

?>

<!DOCTYPE html>
<html lang="en-es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet"
          type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css"/>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <title>Shoppu Shop</title>
    <link rel="icon" href="styles/img/logoBotiga.png">
    <link rel="stylesheet" type="text/css" href="styles/css/styles.css">
</head>

<body>


<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php"><img src="styles/img/logoBotiga.png"  alt="" /></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ml-1"></i>
        </button>
        <?php if (isset($_SESSION['usuariLogged'])):
            if ($_SESSION['usuariLogged']->getRol()==0 || $_SESSION['usuariLogged']->getRol()==1 ){?>
                <div class="collapse navbar-collapse float-left" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ml-auto">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="vista/perfil.php">Hi, <?php echo $_SESSION['usuariLogged']->getNom();?></php></a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="vista/adminPanel.php">Admin panel</php></a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about-us">About us</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#id-man">Men</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#id-woman">Women</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?logout=ture">Log out</a></li>
                    </ul>
                </div>
            <?php  } else {?>
                <div class="collapse navbar-collapse float-left" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ml-auto">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="vista/perfil.php">Hi, <?php echo $_SESSION['usuariLogged']->getNom();?></php></a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about-us">About us</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#id-man">Men</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#id-woman">Women</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?logout=ture">Log out</a></li>
                    </ul>
                </div>

            <?php }?>
        <?php else: ?>
            <div class="collapse navbar-collapse float-left" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ml-auto">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about-us">About us</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#id-man">Men</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#id-woman">Women</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="vista/login.php">Log in</a></li>
                </ul>
            </div>
         <?php endif;?>
    </div>
</nav>



<header class="masthead">
    <div class="container">
        <div class="masthead-subheading">Start shopping...</div>
        <div class="masthead-heading text-uppercase"></div>
        <a href="vista/shopMen.php" class="btn effect04" data-sm-link-text="SHOP" ><span>Shop</span></a>
    </div>
</header>
<?php if (isset($_SESSION['usuariLogged'])){
    if($_SESSION['usuariLogged']->getActivat()==false) :

        ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert" style="position:absolute; width: 100%; text-align: center" >
            <strong>Your account is unverified.</strong> Go check your email and verify it.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION['adminToNoAdmin']); endif; }?>

<?php if (isset($_GET['logout'])){ ?>

        <div class="alert alert-warning alert-dismissible fade show" role="alert" style="position:absolute; width: 100%; text-align: center" >
            <strong>Logged Out correctly</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_GET['logout']);  }?>
<section class="page-section section0" id="about-us">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">About Us</h2>
            <h3 class="section-subheading text-muted">Who we are?</h3>
        </div>
        <div class="row text-center align-content-center">
            <div class="col-md-12">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-tshirt fa-stack-2x text-primary"></i>
                    </span>
                <p class="text-muted"><br>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            </div>
        </div>

    </div>
</section>

<section class="page-section section1" id="id-man">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Men Collection</h2>
            <h3 class="section-subheading text-muted">What do we have for men</h3>
        </div>
        <div class="row text-center align-content-center">
            <div class="col-md-12">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-mars fa-stack-2x text-primary"></i>
                    </span>
                <p class="text-muted"> <br>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it
                    to make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                    typesetting, remaining essentially unchanged. </p>

                <p class="text-muted"> It was popularised in the 1960s with the release of Letraset
                    sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus
                    PageMaker including versions of Lorem Ipsum. </p>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6 mt-5 mb-3 xd">
                <a href="#">
                    <img src="styles/img/semarreta-1-1.jpg" class="img-fluid imatgee" alt="Responsive image"/>
                    <div class="overlay">
                        <div class="text">Go shop now</div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 mt-5 mb-3 xd">
                <a href="#">
                    <img src="styles/img/semarreta-2-1.jpg" class="img-fluid imatgee" alt="Responsive image"/>
                    <div class="overlay">
                        <div class="text">Go shop now</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="page-section section2" id="id-woman">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Women Collection</h2>
            <h3 class="section-subheading text-muted">What do we have for women</h3>
        </div>
        <div class="row text-center align-content-center">
            <div class="col-md-12">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-venus fa-stack-2x text-primary"></i>
                    </span>
                <p class="text-muted"> <br>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6 mt-5 mb-3 xd">
                <a href="#">
                    <img src="styles/img/semarretaD-1-1.jpg" class="img-fluid imatgee" alt="Responsive image" />
                    <div class="overlay">
                        <div class="text">Go shop now</div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 mt-5 mb-3 xd">
                <a href="#">
                    <img src="styles/img/semarretaD-2-1.jpg" class="img-fluid imatgee" alt="Responsive image" />
                    <div class="overlay">
                        <div class="text">Go shop now</div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</section>

<div class="container-fluid pb-0 mb-0 justify-content-center text-light ">
    <footer>
        <div class="row my-5 justify-content-center py-5">
            <div class="col-11">
                <div class="row ">
                    <div class="col-xl-8 col-md-4 col-sm-4 col-12 my-auto mx-auto a">
                        <h3 class="text-muted mb-md-0 mb-5 bold-text">SHOPPU SHOP</h3>
                    </div>
                    <div class="col-xl-2 col-md-4 col-sm-4 col-12">
                        <h6 class="mb-3 mb-lg-4 bold-text "><b>MENU</b></h6>
                        <ul class="list-unstyled">
                            <li> <a href="vista/register.php">Register</a></li>
                            <li> <a href="vista/login.php">Login</a></li>
                            <li> <a href="">Shop</a></li>
                        </ul>
                    </div>
                    <div class="col-xl-2 col-md-4 col-sm-4 col-12">
                        <h6 class="mb-3 mb-lg-4 text-muted bold-text mt-sm-0 mt-5"><b>ADDRESS</b></h6>
                        <p class="mb-1">08570 Torelló, Barcelona</p>
                        <p>Carrer autista March, s/n</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<!--bootstrap-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
<script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>

<!-- Third party plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="styles/js/script.js"></script>
</body>
</html>