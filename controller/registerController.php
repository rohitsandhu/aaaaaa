<?php
session_start();
require '../classes/Conexio.php';
require '../classes/Usuari.php';
require 'sendMail.php';

////////// funcions per fer el register

$con = new Conexio();

$nomOk = $contraOk = $contra2Ok = $cognomsOk = $correuOk =  $captchaOk= true;
$_SESSION['correu'] = $_SESSION['nom'] = $_SESSION['cognoms'] = $_SESSION['contra2'] = $_SESSION['contra'] = "";
$_SESSION['correuErr'] = $_SESSION['nomErr'] = $_SESSION['cognomsErr']=  $_SESSION['contra2Err'] = $_SESSION['contraErr'] = $_SESSION['recaptchaErr'] = "";

$_SESSION['correu']= test_input($_POST['correu']);
$_SESSION['nom'] = test_input($_POST['nom']);
$_SESSION['cognoms']= test_input($_POST['cognoms']);
$_SESSION['contra']= test_input($_POST['contra']);
$_SESSION['contra2']= test_input($_POST['contra2']);

    if(isset($_GET['comprovarRegister'])){

        if (empty($_SESSION['correu'])) {
            $_SESSION['correuErr'] = "* Email is required";
            $correuOk = false;
        } else {

            if (!filter_var($_SESSION['correu'], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['correuErr'] = "* Only letters, numbers are allowed and the format of the mail must be correct";
                $correuOk = false;
            }

            $con->openConnection();
            $arrayUsuaris = $con->getAllUsuaris();
            $con->closeConnection();

            for($i =0; $i<count($arrayUsuaris); $i++ ){
                if($arrayUsuaris[$i]->getCorreu()==$_SESSION['correu']){
                    $_SESSION['correuErr'] = "* An account with this email already exists";
                    $correuOk = false;
                    break;
                }
            }
        }
        if (empty($_SESSION['contra'])) {
            $_SESSION['contraErr'] = "* Password is required";
            $contraOk = false;
        } else {
            if (!preg_match("/^[a-zA-Z-' 0-9]*$/",$_SESSION['contra'])) {
                $_SESSION['contraErr'] = "* Only letters, numbers and whitespace are allowed";
                $contraOk= false;
            }
        }
        if (empty($_SESSION['nom'])) {
            $_SESSION['nomErr'] = "* Name is required";
            $nomOk=false;
        } else {
            if (!preg_match("/^[a-zA-Z-' ]*$/",$_SESSION['nom'])) {
                $_SESSION['nomErr'] = "* Only letters and whitespace are allowed";
                $nomOk=false;
            }
        }
        if (empty($_SESSION['cognoms'])) {
            $_SESSION['cognomsErr'] = "* Surname is required";
            $cognomsOk=false;
        } else {
            if (!preg_match("/^[a-zA-Z-' ]*$/",$_SESSION['cognoms'])) {
                $_SESSION['cognomsErr'] = "* Only letters and whitespace are allowed";
                $cognomsOk= false;
            }
        }
        if (empty($_SESSION['contra2'])) {
            $_SESSION['contra2Err'] = "* Password check missing";
            $contra2Ok=false;
        } else {
            if ($_SESSION['contra2']!=$_SESSION['contra']) {
                $_SESSION['contra2Err'] = "* Passwords do not match ";
                $contra2Ok=false;
            }
        }
        if (!$_POST['g-recaptcha-response']){

            $captchaOk= false;
            $_SESSION['recaptchaErr'] = '* Fill the captcha';
        }
    }else{
        $nomOk = $contraOk = $cognomsOk = $correuOk = $contra2Ok = $captchaOk = false;
        header('Location: ../vista/register.php');
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if($nomOk && $contraOk && $correuOk && $cognomsOk && $contra2Ok && $captchaOk){
        $con->openConnection();

        $contraEncrypt = password_hash($_SESSION['contra'], PASSWORD_DEFAULT);

        $token = md5(uniqid(mt_rand(),false));

        $rol = 2;
        $user = new Usuari();
        $user->setCorreu($_SESSION['correu']);
        $user->setCognoms($_SESSION['cognoms']);
        $user->setNom($_SESSION['nom']);
        $user->setContra($contraEncrypt);
        $user->setRol($rol);
        $user->setToken($token);
        $con->addUsuari($user);

        $_SESSION['usuariLogged'] = $con->getUsuariPerCorreu($_SESSION['correu']);
        $con->closeConnection();
//        var_export($_SESSION['usuariLogged']);
        sendMail($_SESSION['usuariLogged']);
        $_SESSION['correu'] = $_SESSION['nom'] = $_SESSION['cognoms'] = $_SESSION['contra2'] = $_SESSION['contra'] = "";
        $_SESSION['correuErr'] = $_SESSION['nomErr'] = $_SESSION['cognomsErr']=  $_SESSION['contra2Err'] = $_SESSION['contraErr'] = $_SESSION['recaptchaErr'] = "";
        header("Location: ../index.php?logged=ok");
    }else{
        header("Location: ../vista/register.php?error=true");
    }


?>