<?php
include '../classes/Usuari.php';
include '../classes/Comanda.php';
include '../classes/Conexio.php';
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$con = new Conexio();


if (!isset($_SESSION['usuariLogged'])) {
    header('Location: ../index.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.22/r-2.2.6/datatables.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/dt/dt-1.10.22/r-2.2.6/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/r-2.2.6/datatables.min.js"></script>

    <link rel="icon" href="../styles/img/logoBotiga.png">
    <link rel="stylesheet" href="../styles/css/styles.css">
    <title>Your Orders</title>
</head>

<body class="body2">
<nav class="navbar navbar-expand-sm  navbar-light bg-light custom-navbar">
    <a href="../index.php" class="navbar-brand" style=" margin='10px'">
        <img src="../styles/img/logoBotiga.png" height="50" alt=""/></a>

    <li class="nav-item mr-auto">
        <a class="btn-light btn" href="../vista/perfil.php"> Profile </a>
    </li>
    <li class="nav-item ml-auto">
        <a class="btn-light btn" href="../index.php?logout=true"> Log Out </a>
    </li>
</nav>

<div class="container mt-5">
    <h3 class="mt-5">
        Your Orders
    </h3>
</div>

<style>
    .dataTables_wrapper .dataTables_filter input {
        background-color: rgba(255, 255, 255, 0.6);
    }
</style>

<div class="container mt-4 p-3 rounded" style="background-color: rgba(255,255,255, 0.6)">
    <div class="row">
        <div class="col-12">
            <table id="example" class="table table-striped table-bordered" style="width:100%; background-color: white;">
                <thead>
                <tr>
                    <td>Order ID</td>
                    <td>Iva</td>
                    <td>Price w/out iva</td>
                    <td>Date</td>
                    <td>Total price</td>
                    <td>Action</td>
                </tr>
                </thead>
                <tbody>

                    <?php
                    $con->openConnection();
                    $arrayFacuras = $con->getAllFacturas($_SESSION['usuariLogged']->getIdUsuari());
                    $con->closeConnection();
                    ?>

                    <?php if (count($arrayFacuras) > 0): ?>

                        <?php foreach ($arrayFacuras as $f): ?>
                    <tr>
                            <td> <?php echo $f->getIdComanda(); ?> </td>
                            <td> <?php echo $f->getComandaIva() . "€"; ?> </td>
                            <td> <?php echo $f->getPreuTotal() . "€"; ?> </td>
                            <td> <?php echo $f->getData(); ?> </td>
                            <td> <?php echo $f->getComandaIva() + $f->getPreuTotal() . "€"; ?> </td>
                            <td><a href="pdf.php?idComanda=<?php echo $f->getIdComanda(); ?>" class="btn btn-light">See
                                    more</a></td>
                    </tr>
                        <?php endforeach; ?>

                    <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#example')
            .addClass('nowrap')
            .dataTable({
                responsive: true,
                columnDefs: [
                    {targets: [0, 1], className: 'dt-body-right'}
                ]
            });
    });
</script>

</body>
</html>
