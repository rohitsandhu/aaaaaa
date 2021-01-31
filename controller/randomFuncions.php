<?php


include '../classes/Usuari.php';
include '../classes/Conexio.php';

session_start();

$con = new Conexio();


if(isset($_POST['address'])){


    if ($_POST['address']!=""){

        $con->openConnection();

        $con->changeAddress($_SESSION['usuariLogged']->getIdUsuari(),$_POST['address']);
        $_SESSION['usuariLogged']= $con->getUsuariById($_SESSION['usuariLogged']->getIdUsuari());
        $con->closeConnection();


        $_SESSION['addressOk'] = "xd";


        header('Location: ../vista/paginaCarrito.php');

    }else{


        $_SESSION['addressNotOk'] = "xd";
        header('Location: ../vista/paginaCarrito.php');
    }

}else{

    $_SESSION['addressNotOk'] = "xd";
    header('Location: ../vista/paginaCarrito.php');
}