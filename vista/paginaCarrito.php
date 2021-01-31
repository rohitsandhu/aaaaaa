<?php
include '../classes/Usuari.php';
include '../classes/Producte.php';
include '../classes/Conexio.php';
include '../classes/LiniaComanda.php';
include '../classes/Comanda.php';
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['usuariLogged'])) {
    header('Location: ../index.php');
}

$con = new Conexio();

$con->openConnection();

$_SESSION['array'] = $con->getLiniasComandaPerIdUsuari($_SESSION['usuariLogged']);

$con->closeConnection();


if (count($_SESSION['array']) > 0) {

} else {
    unset($_SESSION['array']);
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CART</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <!--    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">-->

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
          crossorigin="anonymous"/>


    <style>
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-button {
            width: 8px;
            height:5px;
        }
        ::-webkit-scrollbar-track {
            background:#ffffff;
            border: thin solid lightgray;
            box-shadow: 0px 0px 3px #dfdfdf inset;
            border-radius:10px;
        }
        ::-webkit-scrollbar-thumb {
            background:#eee6ff;
            border: thin solid gray;
            border-radius:10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background:#7d7d7d;
        }
    </style>

</head>

<body>


<nav class="navbar navbar-expand-lg  mb-2 navbar-light bg-light">
    <a href="../index.php" class="navbar-brand" style=" margin='10px'">
        <img src="../styles/img/logoBotiga.png" height="50" alt=""/>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

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
                    <a class="btn-light btn" href="../index.php?logout=true">Log Out</a>
                </li>
            </ul>

        <?php endif; ?>
    </div>
</nav>

<?php if (isset($_SESSION['borrat'])) : ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom: 0">
        <strong>Product removed successfully from your cart.</strong>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php endif;
unset($_SESSION['borrat']);
?>

<?php if (isset($_SESSION['compraFeta'])) : ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom: 0">
        <strong> The purchase was successful.</strong>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php endif;

unset($_SESSION['compraFeta']);
?>



<?php if ( isset($_SESSION['addressNotOk'])) : ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-bottom: 0">
        <strong>Please specify the address before buying </strong>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php endif;

unset($_SESSION['addressNotOk']);
?>

<?php if ( isset($_SESSION['addressOk'])) : ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom: 0">
        <strong> Address updadet correctly </strong>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php endif;

unset($_SESSION['addressOk']);
?>




<?php if (isset($_SESSION['errorAlComprar'])) : ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-bottom: 0">
        <strong> Error doing the purchase</strong> Please delete the following products and add them again there was an
        error with the stock.

        <?php foreach ($_SESSION['errorAlComprar'] as $v): ?>

            <?php if ($v == null): echo "There were some problems buying"; endif;
            break; ?>

            <br>- <?php echo $v->getNom(); ?>


        <?php endforeach; ?>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php endif;

unset($_SESSION['errorAlComprar']);
?>


<div class="px-4 px-lg-0">
    <!-- For demo purpose -->
    <div class="container text-secondary py-5 text-center">
        <h1 class="display-4"><strong> YOUR CART </strong></h1>
    </div>
    <!-- End -->

    <div class="pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

                    <!-- Shopping cart table -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="p-2 px-3 text-uppercase">Product</div>
                                </th>

                                <th scope="col" class="border-0 bg-light" style="text-align:center;">
                                    <div class="py-2 text-uppercase">Quantity</div>
                                </th>

                                <th scope="col" class="border-0 bg-light" style="text-align:center;">
                                    <div class="py-2 text-uppercase"> Indv. price</div>
                                </th>

                                <th scope="col" class="border-0 bg-light" style="text-align:center;">
                                    <div class="py-2 text-uppercase">Full price</div>
                                </th>
                                <th scope="col" class="border-0 bg-light" style="text-align:center;">
                                    <div class="py-2 text-uppercase">Remove</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sumaTotalPog = 0;
                            $idComanda = "";
                            ?>
                            <?php if (isset($_SESSION['array'])): ?>

                                <?php foreach ($_SESSION['array'] as $lc): ?>

                                    <?php
                                    $idComanda = $lc->getIdComanda();
                                    $con->openConnection();
                                    $prod = $con->getProductePerID($lc->getIdProducte());
                                    $con->closeConnection();

                                    if (isset($prod)):
                                        ?>

                                        <tr>
                                            <th scope="row" class="border-0">
                                                <div class="p-2">
                                                    <img src="<?php echo $prod->getLinkImatge(); ?>" alt="" width="80"
                                                         class="img-fluid rounded shadow-sm">
                                                    <div class="ml-3 d-inline-block align-middle">
                                                        <h5 class="mb-0"><a
                                                                    href="detallProducte.php?idProducte=<?php echo $prod->getIdProducte(); ?>"
                                                                    class="text-dark d-inline-block align-middle"><?php echo $prod->getNom(); ?></a>
                                                        </h5>
                                                        <span class="text-muted font-weight-normal font-italic d-block">Category: <?php echo $prod->getCategoria(); ?></span>
                                                        <span class="text-muted font-weight-normal font-italic d-block">Size: <?php echo $lc->getTalla(); ?></span>
                                                    </div>
                                                </div>
                                            </th>
                                            <td class="border-0 align-middle" style="text-align:center;">
                                                <strong><?php echo $lc->getQuantitat(); ?></strong></td>
                                            <td class="border-0 align-middle" style="text-align:center;">
                                                <strong><?php echo $prod->getPreu() ?>€</strong></td>
                                            <td class="border-0 align-middle" style="text-align:center;">
                                                <strong><?php echo $lc->getPreuTotal(); ?>€</strong></td>
                                            <?php $sumaTotalPog = $sumaTotalPog + $lc->getPreuTotal() ?>
                                            <td class="border-0 align-middle" style="text-align:center;">
                                                <a href="../controller/procedirAComprar.php?lc=<?php echo $lc->getIdLiniaComanda(); ?>"
                                                   class="text-dark">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>

                                    <?php
                                    endif;

                                endforeach; ?>

                            <?php else: ?>


                            <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                    <!-- End -->
                </div>
            </div>


            <?php if ($_SESSION['usuariLogged']->getAdreça() == null && isset($_SESSION['array'])): ?>
                <div class="pb-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

                                <div>
                                    <h5> You still haven't specified your address </h5>
                                </div>


                                <div>
                                    <form action="../controller/randomFuncions.php" method="post">

                                        <label for="address"></label>
                                        <div class="form-group ">
                                            <input type="text" class="form-control"
                                                   placeholder="Write your address please..." name="address"
                                                   id="address" required>
                                            <button type="submit" class="btn btn-light mt-3"> Save Address</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            <?php endif; ?>

            <div class="row py-5 p-4 bg-white rounded shadow-sm">
                <div class="col-lg-6">
                    <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Paypal</div>
                    <div class="p-4">
                        <p class="font-italic mb-4">Payment only with paypal</p>
                        <div id="smart-button-container">
                            <div style="text-align: center;">
                                <div id="paypal-button-container"></div>
                            </div>
                        </div>
                        <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD"
                                data-sdk-integration-source="button-factory"></script>
                        <script>
                            function initPayPalButton() {
                                paypal.Buttons({
                                    style: {
                                        shape: 'rect',
                                        color: 'gold',
                                        layout: 'vertical',
                                        label: 'paypal',

                                    },

                                    createOrder: function (data, actions) {
                                        return actions.order.create({
                                            purchase_units: [{"amount": {"currency_code": "USD", "value": 1}}]
                                        });
                                    },

                                    onApprove: function (data, actions) {
                                        return actions.order.capture().then(function (details) {
                                            alert('Transaction completed by ' + details.payer.name.given_name + '!');
                                        });
                                    },

                                    onError: function (err) {
                                        console.log(err);
                                    }
                                }).render('#paypal-button-container');
                            }

                            initPayPalButton();
                        </script>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary
                    </div>
                    <div class="p-4">
                        <p class="font-italic mb-4">Shipping and additional costs are calculated based on values
                            you
                            have entered.</p>
                        <?php if ($sumaTotalPog > 0): ?>
                            <ul class="list-unstyled mb-4">
                                <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                            class="text-muted">Order
                                        Subtotal </strong><strong> <?php echo $sumaTotalPog; ?>€ </strong></li>
                                <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                            class="text-muted">Shipping and
                                        handling</strong><strong>0.0€</strong></li>
                                <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                            class="text-muted">IVA(Spain)</strong><strong><?php echo number_format($sumaTotalPog * 0.21, 2); ?>
                                        €</strong></li>
                                <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                            class="text-muted">Total</strong>
                                    <h5 class="font-weight-bold"><?php echo number_format($sumaTotalPog + ($sumaTotalPog * 0.21), 2); ?>
                                        €</h5>
                                </li>
                            </ul>
                            <a href="../controller/procedirAComprar.php?idUser=<?php echo $_SESSION['usuariLogged']->getIdUsuari(); ?>&idComanda=<?php echo $idComanda; ?>"
                               class="btn btn-dark rounded-pill py-2 btn-block">Procceed to checkout</a>
                        <?php else: ?>
                            <ul class="list-unstyled mb-4">
                                <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                            class="text-muted">Order Subtotal </strong><strong> 0.00€ </strong>
                                </li>
                                <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                            class="text-muted">Shipping and
                                        handling</strong><strong>0.00€</strong></li>
                                <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                            class="text-muted">IVA(Spain)</strong><strong>0.00€</strong></li>
                                <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                            class="text-muted">Total</strong>
                                    <h5 class="font-weight-bold">0.00€</h5>
                                </li>
                            </ul><a href="../controller/procedirAComprar.php"
                                    class="btn btn-dark rounded-pill py-2 btn-block">Procceed to checkout</a>
                        <?php endif; ?>


                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>


</body>
</html>
