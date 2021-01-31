<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include '../classes/Usuari.php';
include '../classes/Producte.php';
include '../controller/funcions.php';
include '../classes/Comanda.php';
include '../classes/LiniaComanda.php';
include '../classes/Conexio.php';
//session_start();

$con = new Conexio();


if (!isset($_SESSION['usuariLogged'])) {
    $_SESSION['noPotComprar'] = 'text';
    header('location: ../vista/login.php');
    die();
}

$_SESSION['arrayErrorsAfegirCarrito'] = [];

$talla = $_POST['talla'];
$idProducte = intval($_POST['idProducte']);
$quantitat = intval($_POST['quantitat']);

$tallaOk = comprobarTalla($talla);
$quantitatOk = comprobarQuantitat2($quantitat);


if ($_SESSION['usuariLogged']->getActivat()==false){



    $_SESSION['verify'] = "tezt";
    header('Location: ../vista/detallProducte.php?idProducte=' . $_POST['idProducte']);

    die();
}





if ($tallaOk && $quantitatOk) {

    $con->openConnection();
    $quantitatDelProducteOk = $con->comprobarQuanitatDelProducte($talla, $idProducte, $quantitat);
    $con->closeConnection();

    if ($quantitatDelProducteOk) {

        echo "pog c compro";


        $con->openConnection();
        $comandaComençadaOk = $con->comprobarComandaComançada($_SESSION['usuariLogged']->getIdUsuari());
        $con->closeConnection();
        if ($comandaComençadaOk) {

            $con->openConnection();
            $comandaAmbElproducteITallaIgualsOk = $con->comprobarProducteITallaEnLaComandaNoAcabada($talla, $idProducte, $_SESSION['usuariLogged']->getIdUsuari());
            $con->closeConnection();

            if ($comandaAmbElproducteITallaIgualsOk) {
                $con->openConnection();
                $comprobarSumantQuantitats = $con->comprobarSumantQuantitats($talla, $idProducte, $_SESSION['usuariLogged']->getIdUsuari(), $quantitat);
                $con->closeConnection();

                if ($comprobarSumantQuantitats) {


                    //afegir en la mateixa linia de la comanda i modificar tot
                    $con->openConnection();
                    $con->actualitzarLiniaComanda($talla, $idProducte, $_SESSION['usuariLogged']->getIdUsuari(), $quantitat);
                    $con->closeConnection();

                    $_SESSION['producteAfegit'] = "tezt";
                    unset($_SESSION['arrayErrorsAfegirCarrito']);

                    header('Location: ../vista/detallProducte.php?idProducte=' . $_POST['idProducte']);
                } else {
                    /////// la suma del mateix producte no es correcte

                    //afegit al array errors
                    header('Location: ../vista/detallProducte.php?idProducte=' . $_POST['idProducte']);
                }
            } else {

                //crear la linia comanda

                $con->openConnection();

                $prod = $con->getProductePerID($idProducte);

                $liniaComanda = new LiniaComanda();
                $liniaComanda->setIdProducte($idProducte);
                $liniaComanda->setQuantitat($quantitat);
                $liniaComanda->setTalla($talla);
                $liniaComanda->setPreuTotal(floatval($prod->getPreu()) * intval($quantitat));

                $con->afegirNovaLiniaEnLaComanda($liniaComanda, $_SESSION['usuariLogged']);

                $con->closeConnection();


                $_SESSION['producteAfegit'] = "tezt";
                unset($_SESSION['arrayErrorsAfegirCarrito']);

                header('Location: ../vista/detallProducte.php?idProducte=' . $_POST['idProducte']);


            }


        } else {

//            crear comanda nova

            $con->openConnection();

            $prod = $con->getProductePerID($idProducte);

            $comanda = new Comanda();
            $comanda->setPreuTotal(0);
            $comanda->setAcabat(false);
            $comanda->setIdUsuari($_SESSION['usuariLogged']->getIdUsuari());

            $liniaComanda = new LiniaComanda();
            $liniaComanda->setIdProducte($idProducte);
            $liniaComanda->setQuantitat($quantitat);
            $liniaComanda->setTalla($talla);
            $liniaComanda->setPreuTotal(floatval($prod->getPreu()) * intval($quantitat));

            $con->afegirNovaLiniaEnUnaComandaNova($liniaComanda, $_SESSION['usuariLogged'], $comanda);

            $con->closeConnection();


            $_SESSION['producteAfegit'] = "tezt";
            unset($_SESSION['arrayErrorsAfegirCarrito']);
            header('Location: ../vista/detallProducte.php?idProducte=' . $_POST['idProducte']);

        }

    } else {


        //mirar array errors
        header('Location: ../vista/detallProducte.php?idProducte=' . $_POST['idProducte']);
    }


} else {

    //mirar array errors
    header('Location: ../vista/detallProducte.php?idProducte=' . $_POST['idProducte']);

}