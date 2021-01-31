<?php
include '../classes/Conexio.php';
include '../classes/Usuari.php';
session_start();

$idUsuari= $_GET['idUsuari'] ?? 'noUser';
$token= $_GET['token'] ?? 'noToken';

$con = new Conexio();
$con->openConnection();

$usuariTocken = $con->getTokenByIdUsuari($idUsuari);


$con->closeConnection();

if(strcmp($token,$usuariTocken===0)){
    $con->openConnection();
    $con->activarUser($idUsuari);



    $_SESSION['usuariLogged'] = $con->getUsuariById($idUsuari);



    $con->closeConnection();
    header('Location: ../index.php');
}


unset($_SESSION['recordatori']);
if (isset($_POST['enviar'])) {
    $correu=$_POST['correu'];
    $contrasenya=$_POST['contrasenya'];

    $trobat = false;
    $con->openConnection();
    $arrayClientsExistents = $con->getAllUsuaris();
    for ($i = 0; $i < count($arrayClientsExistents); $i++ ) {
        if (strtoupper ($arrayClientsExistents[$i]->getCorreu()) == strtoupper ($correu) && password_verify($contrasenya, $arrayClientsExistents[$i]->getContra()) ){
            $trobat = true;
            $_SESSION['usuariLogged'] = $arrayClientsExistents[$i];
            break;
        }
        $_SESSION['recordatori'] = "text";
    }

    if (!$trobat) {
        header("Location: ../vista/login.php");
    }else{
        unset($_SESSION['recordatori']);
        header("Location: ../index.php?iniciat=true");
        die();
    }
}

