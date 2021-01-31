<?php
include '../classes/Usuari.php';
include '../classes/Producte.php';
include '../classes/Conexio.php';
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//$_SESSION['arrayErrorsAfegirCarrito'] = $_SESSION['arrayErrorsAfegirCarrito'] ?? [];

if (isset($_GET['idProducte'])) {
    $con = new Conexio();
    $con->openConnection();
    $_SESSION['producte'] = $con->getProductePerID($_GET['idProducte']);
    $con->closeConnection();
}

?>
<!doctype html>
<html lang="en-es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet"
          type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css"/>
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>

    <link rel="icon" href="../styles/img/logoBotiga.png">

    <link rel="stylesheet" href="../styles/css/styles.css">

    <style>

        .zoom {
            display: inline-block;
            position: relative;
        }

        /* magnifying glass icon */

        .zoom:after {
            content: '';
            display: block;
            width: 33px;
            height: 33px;
            position: absolute;
            top: 0;
            right: 0;
            background: url();
        }

        .zoom img {
            display: block;
        }

        .zoom img::selection {
            background-color: transparent;
        }
    </style>
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
    <script src='jquery.zoom.js'></script>
    <script>
        $(document).ready(function () {
            $('#ex1').zoom();
        });
    </script>
    <title>Profile</title>
</head>
<body style="background-color: #f2e6ff">

<nav class="navbar navbar-expand-sm  navbar-light bg-light">
    <a href="../index.php" class="navbar-brand" style=" margin='10px'">
        <img src="../styles/img/logoBotiga.png" height="50"/>
    </a>

    <ul class="navbar-nav text-uppercase mr-auto">
        <li class="nav-item mr-auto">
            <a class="btn-light btn " href=""> </a>
        </li>
        <li class="nav-item mr-auto">
            <a class="btn-light btn " href="shopMen.php"> Men</a>
        </li>
        <li class="nav-item mr-auto">
            <a class="btn-light btn " href="shopWomen.php"> Women</a>
        </li>
        <li class="nav-item mr-auto">
            <a class="btn-light btn" href=""> </a>
        </li>
    </ul>
    <?php if (isset($_SESSION['usuariLogged'])) : ?>

        <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item ml-auto">
                <a class="btn-light btn" href="paginaCarrito.php">Your Cart</a>
            </li>
            <li class="nav-item ml-auto">
                <a class="btn-light btn" href="../index.php?logout=true">Log Out</a>
            </li>
        </ul>

    <?php endif; ?>
</nav>

<?php if (isset($_SESSION['arrayErrorsAfegirCarrito'])) : ?>

    <?php if (count($_SESSION['arrayErrorsAfegirCarrito'])>0): ?>

        <div class="alert alert-danger alert-dismissible fade show" style="margin-bottom: 0" role="alert">
            <strong>There are following errors: </strong>
            <?php for ($i = 0; $i < count($_SESSION['arrayErrorsAfegirCarrito']); $i++): ?>
                <br>

                <p><br> <?php echo $_SESSION['arrayErrorsAfegirCarrito'][$i]; ?> </p>

            <?php endfor; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>
<?php endif;

unset($_SESSION['arrayErrorsAfegirCarrito']);
?>



<?php if (isset($_SESSION['verify'])) : ?>

    <div class="alert alert-danger alert-dismissible fade show" style="margin-bottom: 0" role="alert">
        <strong>Before buying you need to verify your account! </strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php endif;

unset($_SESSION['verify']);
?>

<?php if (isset($_SESSION['producteAfegit'])) : ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom: 0">
        <strong>Product added successfuly to your cart :)</strong>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php endif;

unset($_SESSION['producteAfegit']);
?>

<div class="container-fluid">

    <div class="row">
        <div class="col-lg-6 d-flex justify-content-center" style="background-color: rgba(255,255,255,0.3)">
            <span class='zoom my-5' id='ex1'>
                <img src="<?php echo $_SESSION['producte']->getLinkImatge(); ?>" class="img-fluid" width='700'
                     alt='Product Img'/>
            </span>
        </div>

        <div class="col-lg-6" style="background-color: rgba(255,255,255,0.6)">
            <form class="mt-5" method="post" action="../controller/carrito.php">
                <input type="hidden" name="idProducte" value="<?php echo $_SESSION['producte']->getIdProducte(); ?>">
                <div class="form-group" style="margin-left: 20px;">
                    <h4> <?php echo $_SESSION['producte']->getNom(); ?></h4>
                </div>

                <div class="form-group mt-4" style="margin-left: 20px; ">
                    <h5>Features</h5>

                    <?php if ($_SESSION['producte']->getDescripcio() == ""): ?>
                        <p style="margin-left: 5px; font-style: italic;"> To be Determinated. </p>
                    <?php else: ?>
                        <p style="margin-left: 5px"><?php echo $_SESSION['producte']->getDescripcio(); ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group row"
                     style="margin-left: 20px; margin-right: 20px; overflow: auto; max-height: 250px;">


                </div>

                <div class="form-group">
                    <h6 style="margin-left: 20px;"> Size</h6>

                    <div class="ml-4">
                        <?php if ($_SESSION['producte']->getArrayTalles()['xs'] == 0 && $_SESSION['producte']->getArrayTalles()['s'] == 0 &&
                            $_SESSION['producte']->getArrayTalles()['m'] == 0 && $_SESSION['producte']->getArrayTalles()['l'] == 0 &&
                            $_SESSION['producte']->getArrayTalles()['xl'] == 0 && $_SESSION['producte']->getArrayTalles()['xxl'] == 0 &&
                            $_SESSION['producte']->getArrayTalles()['xxxl'] == 0): ?>
                            <p style="margin-left: 5px; font-style: italic; "> Sold Out </p>


                            <div class="form-group">
                                <p><strong> Individual price: </strong> <?php echo $_SESSION['producte']->getPreu() ?>€
                                </p>
                            </div>

                            <div class="form-group">
                                <label for="quantitat"> <strong>Quantity</strong></label>
                                <input disabled type="number" id="quantitat" name="quantitat" style="width: 100px">
                            </div>

                            <div class="form-group" style="margin-left: 20px">
                                <input disabled type="submit" class="btn btn-light" name="enviar" value="Add to Cart">
                            </div>
                        <?php else: ?>

                            <?php if ($_SESSION['producte']->getArrayTalles()['xs'] > 0): ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="talla" id="xs" value="xs"
                                           required>
                                    <label class="form-check-label" for="xs">XS</label>
                                </div>
                            <?php endif; ?>

                            <?php if ($_SESSION['producte']->getArrayTalles()['s'] > 0): ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="talla" id="s" value="s" required>
                                    <label class="form-check-label" for="s">S</label>
                                </div>
                            <?php endif; ?>

                            <?php if ($_SESSION['producte']->getArrayTalles()['m'] > 0): ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="talla" id="m" value="m" required>
                                    <label class="form-check-label" for="m">M</label>
                                </div>
                            <?php endif; ?>

                            <?php if ($_SESSION['producte']->getArrayTalles()['l'] > 0): ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="talla" id="l" value="l" required>
                                    <label class="form-check-label" for="l">L</label>
                                </div>
                            <?php endif; ?>

                            <?php if ($_SESSION['producte']->getArrayTalles()['xl'] > 0): ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="talla" id="xl" value="xl"
                                           required>
                                    <label class="form-check-label" for="xl">XL</label>
                                </div>
                            <?php endif; ?>

                            <?php if ($_SESSION['producte']->getArrayTalles()['xxl'] > 0): ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="talla" id="xxl" value="xxl"
                                           required>
                                    <label class="form-check-label" for="xxl">XXL</label>
                                </div>
                            <?php endif; ?>

                            <?php if ($_SESSION['producte']->getArrayTalles()['xxxl'] > 0): ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="talla" id="xxxl" value="xxxl"
                                           required>
                                    <label class="form-check-label" for="xxxl">XXXL</label>
                                </div>
                            <?php endif; ?>

                            <div class="form-group" style="margin-left: 20px">
                                <p><strong> Individual price: </strong> <?php echo $_SESSION['producte']->getPreu() ?>€
                                </p>
                            </div>

                            <div class="form-group" style="margin-left: 20px">
                                <label for="quantitat"> <strong>Quantity</strong></label>
                                <input type="number" id="quantitat" name="quantitat" style="width: 100px" required>
                            </div>

                            <div class="form-group" style="margin-left: 20px">
                                <input type="submit" class="btn btn-light" name="enviar" value="Add to Cart">
                            </div>

                        <?php endif; ?>
                    </div>
                </div>

            </form>
        </div>
    </div>


    <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>-->
</body>
</html>


