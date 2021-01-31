<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../classes/Usuari.php';
include '../classes/Producte.php';
include '../controller/funcions.php';
include '../classes/Comanda.php';
include '../classes/LiniaComanda.php';
include '../classes/Conexio.php';
//session_start();

$con = new Conexio();


if ($_SESSION['usuariLogged']->getAdreça() == null){

    $_SESSION['addressNotOk'] = "xd";
    header('Location: ../vista/paginaCarrito.php');
    die();
}

if (isset($_GET['lc'])){

    $con->openConnection();
    $con->borrarLiniaComandaPerID(intval($_GET['lc']));
    $con->closeConnection();

    $_SESSION['borrat'] = "tezt";

    header('Location: ../vista/paginaCarrito.php');
}

if (isset($_GET['idUser']) && isset($_GET['idComanda'])){

    $con->openConnection();
    $con->ferLaCompra(intval($_GET['idUser']), intval($_GET['idComanda']));
    $con->closeConnection();

    header('Location: ../vista/paginaCarrito.php');
}

header('Location: ../vista/paginaCarrito.php');

?>