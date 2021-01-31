<?php
include '../classes/Usuari.php';
include '../classes/Conexio.php';
include '../classes/Producte.php';
include 'funcions.php';
include '../controller/filesaws.php';
session_start();

$con = new Conexio();

if (isset($_POST['enviar'])) {

    $_SESSION['errors'] = [];
    $_SESSION['nom'] = test_input($_POST['nom']) ?? "";
    $_SESSION['descripcio'] = test_input($_POST['descripcio']) ?? "";
    $_SESSION['categoria'] = test_input($_POST['categoria']) ?? "";
    $_SESSION['sexe'] = test_input($_POST['sexe']) ?? "";
    $_SESSION['preu'] = test_input($_POST['preu']) ?? "";
    $_SESSION['uploadFile'] = $_FILES['uploadFile'];
    $_SESSION['xs'] = intval(test_input($_POST['xs'])) ?? 0;
    $_SESSION['s'] = intval(test_input($_POST['s'])) ?? 0;
    $_SESSION['m'] = intval(test_input($_POST['m'])) ?? 0;
    $_SESSION['l'] = intval(test_input($_POST['l'])) ?? 0;
    $_SESSION['xl'] = intval(test_input($_POST['xl'])) ?? 0;
    $_SESSION['xxl'] = intval(test_input($_POST['xxl'])) ?? 0;
    $_SESSION['xxxl'] = intval(test_input($_POST['xxxl'])) ?? 0;

    $nomOk = comprovarNom($_SESSION['nom'], $con);
    $categoriaOk = comprovarCategoria($_SESSION['categoria']);
    $descipcioOk = comprovarDescripcio($_SESSION['descripcio']);
    $sexeOk = comprovarSexe($_SESSION['sexe']);
    $preuOk = comprovarPreu($_SESSION['preu']);
    $imatgeOk = comprovarImatge();
    $xsOk = comprobarXS($_SESSION['xs']);
    $sOk = comprobarS($_SESSION['s']);
    $mOk = comprobarM($_SESSION['m']);
    $lOk = comprobarL($_SESSION['l']);
    $xlOk = comprobarXL($_SESSION['xl']);
    $xxlOk = comprobarXXL($_SESSION['xxl']);
    $xxxlOk = comprobarXXXL($_SESSION['xxxl']);

    if ($nomOk && $categoriaOk && $descipcioOk && $sexeOk && $preuOk && $xsOk && $sOk
        && $mOk && $lOk && $xlOk && $xxlOk && $xxxlOk && $imatgeOk) {

        $arrayImg = imgAlS3();
        $product = new Producte();
        $product->setNom($_SESSION['nom']);
        $product->setPreu($_SESSION['preu']);
        $product->setDescripcio($_SESSION['descripcio']);
        $product->setCategoria($_SESSION['categoria']);
        $product->setSexe($_SESSION['sexe']);
        $product->setExisteix(true);

        $arrayTallas = array(
            "xs" => $_SESSION['xs'],
            "s" => $_SESSION['s'],
            "m" => $_SESSION['m'],
            "l" => $_SESSION['l'],
            "xl" => $_SESSION['xl'],
            "xxl" => $_SESSION['xxl'],
            "xxxl" => $_SESSION['xxxl']
        );

        $product->setArrayTalles($arrayTallas);
        $product->setKeyImatge($arrayImg[0]);
        $product->setLinkImatge($arrayImg[1]);

        $con->openConnection();
        $con->crearProducte($product);
        $con->closeConnection();

        $_SESSION['producteCreat'] = "tezt";
        $_SESSION['nom'] = $_SESSION['descripcio'] = $_SESSION['categoria'] = $_SESSION['sexe'] = $_SESSION['preu'] = $_SESSION['quantitat'] = $_SESSION['mida'] = $_SESSION['uploadFile'] = "";
        header('Location: ../vista/crearProducteAdminPanel.php');
    } else {
        $_SESSION['producteNoCreat'] = "text";
        header('Location: ../vista/crearProducteAdminPanel.php?noCreat=true');
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>



