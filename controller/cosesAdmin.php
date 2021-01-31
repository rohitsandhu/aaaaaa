<?php
require '../classes/Conexio.php';
require '../classes/Usuari.php';
session_start();

$con = new Conexio();

if (isset($_POST['enviar'])){

    $con->openConnection();
    $con->goNoAdminById($_POST['idUser']);
    $_SESSION['usuariLogged'] = $con->getUsuariById($_SESSION['usuariLogged']->getIdUsuari());
    $con->closeConnection();
    $_SESSION['adminToNoAdmin'] = "text";
    header('Location: ../vista/adminPanel.php');
}

if (isset($_POST['enviar2'])){

    $con->openConnection();
    $con->goAdminById($_POST['idUser']);
    $_SESSION['usuariLogged'] = $con->getUsuariById($_SESSION['usuariLogged']->getIdUsuari());
    $con->closeConnection();
    $_SESSION['noAdminToAdmin'] = "text";
    header('Location: ../vista/adminPanel.php');
}

if (isset($_POST['enviar3'])){

    $con->openConnection();
    $con->goVerifiedById($_POST['idUser']);
    $_SESSION['usuariLogged'] = $con->getUsuariById($_SESSION['usuariLogged']->getIdUsuari());
    $con->closeConnection();
    $_SESSION['verifyOk'] = "text";
    header('Location: ../vista/adminPanel.php');
}

if (isset($_POST['delete'])){

    $con->openConnection();
    $con->goDeleteUser($_POST['idUser']);
    $_SESSION['usuariLogged'] = $con->getUsuariById($_SESSION['usuariLogged']->getIdUsuari());
    $con->closeConnection();
    $_SESSION['deleteOk'] = "text";
    header('Location: ../vista/deleteUserAdminPanel.php');
}

?>

