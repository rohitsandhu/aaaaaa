<?php
include '../classes/Conexio.php';
include '../classes/Producte.php';
include '../controller/filesaws.php';
session_start();

$con = new Conexio();

if (isset($_POST['deleteProduct'])){

    $con->openConnection();
    $mirarSiHiHaMesProductesAmbAquestaImatge=$con->contarImatge($_POST['keyImatge']);

    $imatgeBorradaOk = true;
    if($mirarSiHiHaMesProductesAmbAquestaImatge){
        borrarImg($_POST['keyImatge']);
    }
    $con->borrarProducteById($_POST['idProducte']);
    $con->closeConnection();

    $_SESSION['producteBorrat'] = "text";
    header('Location: ../vista/modificarProducteAdminPanel.php');
}







?>