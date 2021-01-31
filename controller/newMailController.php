<?php
session_start();
include '../classes/Usuari.php';
include '../classes/Conexio.php';
require 'sendMail.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$con = new Conexio();



if (isset($_POST['enviar'])){

    if(filter_var($_POST['newMail'], FILTER_VALIDATE_EMAIL)){

        $con-> openConnection();
        if($con->comprovarEmail($_POST['newMail'])){
            $con->desActivarUsuariByMail($_POST['correuHidden']);

            $user= $con->getUsuariPerCorreu($_POST['correuHidden']);

            $con->canviarMailById($user->getIdUsuari(), $_POST['newMail']);
            $user= $con->getUsuariPerCorreu($_POST['newMail']);
            sendMail($user);
            $_SESSION['usuariLogged'] = $user;

            $_SESSION['correuEnviarPerCanviarMail'] = "text";
            header("Location: ../vista/canviarDades.php");
        }else{
            $_SESSION['elCorreuJaExisteix'] = "text";
            header("Location: ../vista/canviarDades.php");
        }
    }else{
        $_SESSION['correuFormatDolent'] = "text";
        header("Location: ../vista/canviarDades.php");
    }
}