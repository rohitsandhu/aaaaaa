<?php
include '../classes/Conexio.php';
include '../classes/Usuari.php';
session_start();
ob_start();
$nomOk = $dniOk = $adreçaOk = $cognomsOk = true;
$_SESSION['nom'] = $_SESSION['cognoms'] = $_SESSION['dni'] = $_SESSION['adreça'] = "";

$con = new Conexio();

$_SESSION['nomErr'] = "";
$_SESSION['cognomsErr'] = "";
$_SESSION['dniErr'] = "";
$_SESSION['adreçaErr'] = "";

$_SESSION['nom'] = test_input($_POST['nom']);
$_SESSION['cognoms'] = test_input($_POST['cognoms']);
$_SESSION['dni'] = test_input($_POST['dni']);
$_SESSION['adreça'] = test_input($_POST['adreça']);


if (isset($_POST['enviar'])) {

    if (empty($_SESSION['nom'])) {
        $_SESSION['nomErr'] = "* Name is required";
        $nomOk = false;
    } else {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $_SESSION['nom'])) {
            $_SESSION['nomErr'] = "* Only letters and whitespace are allowed";
            $nomOk = false;
        }
    }

    if (empty($_SESSION['cognoms'])) {
        $_SESSION['cognomsErr'] = "* Surname is required";
        $cognomsOk = false;
    } else {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $_SESSION['cognoms'])) {
            $_SESSION['cognomsErr'] = "* Only letters and whitespace are allowed";
            $cognomsOk = false;
        }
    }


    if ($_SESSION['adreça'] == "Not Specified") {
        $_SESSION['adreça'] = null;
    }

    if ($_SESSION['dni'] == null) {

    } else {
        if (!checkDni($_SESSION['dni'])) {
            $_SESSION['dniErr'] = "* DNI format es wrong";
            $dniOk = false;
        }
    }
}

if ($nomOk && $cognomsOk && $dniOk && $adreçaOk) {

    $user = $_SESSION['usuariLogged'];
    $user->setCognoms($_SESSION['cognoms']);
    $user->setNom($_SESSION['nom']);
    $user->setAdreça($_SESSION['adreça']);
    $user->setDni($_SESSION['dni']);
    $con->openConnection();
    $con->updateUser($user);
    $_SESSION['usuariLogged'] = $con->getUsuariPerCorreu($user->getCorreu());
    $con->closeConnection();
    $_SESSION['dni'] = $_SESSION['nom'] = $_SESSION['cognoms'] = $_SESSION['adreça'] = "";
    $_SESSION['dniErr'] = $_SESSION['nomErr'] = $_SESSION['cognomsErr'] = $_SESSION['adreçaErr'] = "";
    $_SESSION['dadesCanviadesCorrectament'] = "text";
    header("Location: ../vista/canviarDades.php");
} else {
    $_SESSION['fDades'] = "text";
    header("Location: ../vista/canviarDades.php");
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function checkDni($dni)
{
    $letra = substr($dni, -1);
    $numeros = substr($dni, 0, -1);
    if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros % 23, 1) == mb_strtoupper($letra) && mb_strtoupper(strlen($letra)) == 1 && strlen($numeros) == 8) {
        return true;
    } else {
        return false;
    }
}

