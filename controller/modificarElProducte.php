<?php
include '../classes/Usuari.php';
include '../classes/Conexio.php';
include '../classes/Producte.php';
include '../controller/funcions.php';
include '../controller/filesaws.php';

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$con = new Conexio();

if (isset($_POST['modify'])){
    $_SESSION['errors'] = [];

    $nomOk=comprovarNom2($_POST['nom'], $con, $_SESSION['producteActual']->getNom());
    $categoriaOk= comprovarCategoria($_POST['categoria']);
    $descipcioOk=comprovarDescripcio($_POST['descripcio']);
    $sexeOk=comprovarSexe($_POST['sexe']);
    $preuOk=comprovarPreu($_POST['preu']);
    $xsOk= comprobarXS(intval($_POST['xs']));
    $sOk= comprobarS(intval($_POST['s']));
    $mOk= comprobarM(intval($_POST['m']));
    $lOk= comprobarL(intval($_POST['l']));
    $xlOk= comprobarXL(intval($_POST['xl']));
    $xxlOk= comprobarXXL(intval($_POST['xxl']));
    $xxxlOk= comprobarXXXL(intval($_POST['xxxl']));

//    $_POST['xs'] = $_POST['xs'] =="" ?? 0;

    if ($_POST['xs']==""){
        $_POST['xs']=0;
    }
    if ($_POST['s']==""){
        $_POST['s']=0;
    }
    if ($_POST['m']==""){
        $_POST['m']=0;
    }
    if ($_POST['l']==""){
        $_POST['l']=0;
    }
    if ($_POST['xl']==""){
        $_POST['xl']=0;
    }
    if ($_POST['xxl']==""){
        $_POST['xxl']=0;
    }
    if ($_POST['xxxl']==""){
        $_POST['xxxl']=0;
    }


    if ($_FILES['uploadFile']['name']==null){
        $imatgeOk=true;
    }else{
        $_SESSION['uploadFile'] = $_FILES['uploadFile'];
        $imatgeOk=comprovarImatge();
    }

    if ($nomOk && $categoriaOk && $descipcioOk && $sexeOk && $preuOk && $xsOk && $sOk
        && $mOk && $lOk && $xlOk && $xxlOk && $xxxlOk && $imatgeOk){

        if ($_FILES['uploadFile']['name']==null){

        }else{
            borrarImg($_SESSION['producteActual']->getKeyImatge());
            $arr=imgAlS3();
            $_SESSION['producteActual']->setKeyImatge($arr[0]);
            $_SESSION['producteActual']->setLinkImatge($arr[1]);
        }

        $producte = new Producte();
        $producte->setIdProducte($_SESSION['producteActual']->getIdProducte());
        $producte->setNom($_POST['nom']);
        $producte->setPreu($_POST['preu']);
        $producte->setDescripcio($_POST['descripcio']);
        $producte->setCategoria($_POST['categoria']);
        $producte->setSexe($_POST['sexe']);
        $producte->setKeyImatge($_SESSION['producteActual']->getKeyImatge());
        $producte->setLinkImatge($_SESSION['producteActual']->getLinkImatge());

        $arrayTallas = array(
            "xs" => intval($_POST['xs']),
            "s" => intval($_POST['s']),
            "m" => intval($_POST['m']),
            "l" => intval($_POST['l']),
            "xl" => intval($_POST['xl']),
            "xxl" => intval($_POST['xxl']),
            "xxxl" => intval($_POST['xxxl'])
        );
        $producte->setArrayTalles($arrayTallas);
        $con->openConnection();
        $con->modificarProducte($producte);
        $con->closeConnection();

        $_SESSION['producteModificat']="text";
        header('Location: ../vista/modificarProducteAdminPanel.php');
    }else{

        $_SESSION['producteActual']->setNom($_POST['nom']);
        $_SESSION['producteActual']->setDescripcio($_POST['descripcio']);
        $_SESSION['producteActual']->setCategoria($_POST['categoria']);

        $arrayTallas = array(
            "xs" => intval($_POST['xs']),
            "s" => intval($_POST['s']),
            "m" => intval($_POST['m']),
            "l" => intval($_POST['l']),
            "xl" => intval($_POST['xl']),
            "xxl" => intval($_POST['xxl']),
            "xxxl" => intval($_POST['xxxl'])
        );

        $_SESSION['producteActual']->setArrayTalles(($arrayTallas));
        $_SESSION['producteActual']->setSexe($_POST['sexe']);
        $_SESSION['producteActual']->setPreu($_POST['preu']);
//        $_SESSION['producteActual']->setQuantitat($_POST['quantitat']);
        $_SESSION['producteNoModificat'] = "text";
        header('Location: ../vista/modificarProducteProducteAdminPanel.php?noModificat=true');
    }
}