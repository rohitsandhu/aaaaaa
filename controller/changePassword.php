<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../classes/Conexio.php';
include '../classes/Usuari.php';
require 'sendMail.php';
ob_start();
$con = new Conexio();

$trobat = false;


if (isset($_POST['enviar'])){
    $con->openConnection();
    $arrayClientsExistents = $con->getAllUsuaris();
    $con->closeConnection();
    if(isset($_POST['correuHidden'])){
        $_POST['correu'] = $_POST['correuHidden'];
    }
    for ($i = 0; $i < count($arrayClientsExistents); $i++ ) {
        if ($arrayClientsExistents[$i]->getCorreu() == $_POST['correu']){
            sendMailCanviarContrasenya($arrayClientsExistents[$i]);
            $trobat = true;
            break;
        }
    }
    if (!$trobat) {

        if(isset($_POST['correuHidden'])){
            $_SESSION['correuNoTrobat'] = "text";
            header("Location: ../vista/canviarDades.php");
        }else{
            $_SESSION['correuNoTrobat'] = "text";
            header("Location: ../vista/correu.php");
        }
    }else{

        if(isset($_POST['correuHidden'])){
            $_SESSION['correuTrobat'] = "text";
            header("Location: ../vista/canviarDades.php");
        }else{
            $_SESSION['correuTrobat'] = "text";
            header("Location: ../vista/correu.php");
        }
    }
}

$idUsuari= $_GET['idUsuari'] ?? 'noUser';
$token= $_GET['token'] ?? 'noToken';


if($idUsuari!='noUser'){
    $con->openConnection();
    $usuari= $con->getUsuariById($idUsuari);
    $usuariTocken = $con->getTokenByIdUsuari($idUsuari);

    $con->closeConnection();

    if(strcmp($token,$usuariTocken===0)){

        header('Location: ../vista/password.php?idUsuari='.$idUsuari.'&token='.$token);
    }else{
        header('Location: ../index.php');
    }
}

?>