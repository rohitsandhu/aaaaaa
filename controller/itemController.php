<?php
include '../classes/Usuari.php';
include '../classes/Conexio.php';
include '../classes/Producte.php';
include '../controller/funcions.php';

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$con = new Conexio();
$con->openConnection();
$_SESSION['productes'] = $con->getProductesShop($_GET['radio1'], $_GET['radio2'], $_GET['radio3'], $_GET['ordenar'], $_GET['sexe']);
$con->closeConnection();

header('Location: ../vista/shopItems.php');