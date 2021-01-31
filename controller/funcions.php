<?php

//include '../classes/Conexio.php';
session_start();
ob_start();


function comprovarNom($text, $con)
{
    if ($text == "") {
        array_push($_SESSION['errors'], "* Name field is Required");
        return false;
    } else {

        $con->openConnection();
        if ($con->comprovarNomProducte($text)) {
            array_push($_SESSION['errors'], "* There's already another product with this name");
            return false;
        }
        $con->closeConnection();
        return true;
    }
}

function comprovarNom2($text, $con, $nomActual)
{
    if ($text == "") {
        array_push($_SESSION['errors'], "* Name field is Required");
        return false;
    } else {

        if ($text != $nomActual) {
            $con->openConnection();

            if ($con->comprovarNomProducte($text)) {
                array_push($_SESSION['errors'], "* There's already another product with this name");
                return false;
            }
            $con->closeConnection();
        }
        return true;
    }
}

function comprovarDescripcio($text)
{
    if ($text == "") {
        array_push($_SESSION['errors'], "* Description field is Required");
        return false;
    } else {
        return true;
    }
}

function comprovarPreu($text)
{
    if ($text == "") {
        array_push($_SESSION['errors'], "* Price field is Required");
        return false;
    } else {
        return true;
    }
}

//function comprovarQuantitat($text){
//    if ($text==""){
//        array_push($_SESSION['errors'], "* Quantity field is Required");
//        return false;
//    }else{
//        return true;
//    }
//}
//
//function comprovarTalla($text){
//    if ($text==""){
//        array_push($_SESSION['errors'], "* Size field is Required");
//        return false;
//    }else{
//        return true;
//    }
//}

function comprobarXS($text)
{
    if ($text == "") {
        return true;
    } else {
        if (is_int($text) && $text >= 0) {
            return true;
        } else {
            array_push($_SESSION['errors'], "* Error in XS textfield");
            return false;
        }
    }
}

function comprobarS($text)
{
    if ($text == "") {
        return true;
    } else {
        if (is_int($text) && $text >= 0) {
            return true;
        } else {
            array_push($_SESSION['errors'], "* Error in S textfield");
            return false;
        }
    }
}

function comprobarM($text)
{
    if ($text == "") {
        return true;
    } else {
        if (is_int($text) && $text >= 0) {
            return true;
        } else {
            array_push($_SESSION['errors'], "* Error in M textfield");
            return false;
        }
    }
}

function comprobarL($text)
{
    if ($text == "") {
        return true;
    } else {
        if (is_int($text) && $text >= 0) {
            return true;
        } else {
            array_push($_SESSION['errors'], "* Error in L textfield");
            return false;
        }
    }
}

function comprobarXL($text)
{
    if ($text == "") {
        return true;
    } else {
        if (is_int($text) && $text >= 0) {
            return true;
        } else {
            array_push($_SESSION['errors'], "* Error in XL textfield");
            return false;
        }
    }
}

function comprobarXXL($text)
{
    if ($text == "") {
        return true;
    } else {
        if (is_int($text) && $text >= 0) {
            return true;
        } else {
            array_push($_SESSION['errors'], "* Error in XXL textfield");
            return false;
        }
    }
}

function comprobarXXXL($text)
{
    if ($text == "") {
        return true;
    } else {
        if (is_int($text) && $text >= 0) {
            return true;
        } else {
            array_push($_SESSION['errors'], "* Error in XXXL textfield");
            return false;
        }
    }
}


function comprovarSexe($text)
{
    if ($text == "") {
        array_push($_SESSION['errors'], "* 'Is for' field is Required");
        return false;
    } else {
        return true;
    }
}

function comprovarCategoria($text)
{
    if ($text == "") {
        array_push($_SESSION['errors'], "* Category field is Required");
        return false;
    } else {
        return true;
    }
}

function comprovarImatge()
{

    if ($_SESSION['uploadFile']['type'] == null || $_SESSION['uploadFile']['type'] == "") {
        array_push($_SESSION['errors'], "* This does not contain images");
        return false;
    } else {
        if ($_SESSION['uploadFile']['type'] == "image/jpeg" || $_SESSION['uploadFile']['type'] == "image/png" || $_SESSION['uploadFile']['type'] == "image/jpg") {


            list($width, $height) = getimagesize($_SESSION['uploadFile']['tmp_name']);
            if (abs($width - $height) < 50) {
                return true;
            } else {
                array_push($_SESSION['errors'], "* Image size is incorrect (Image size needs to be closely height=width ( max 50 pixel diference))");
                return false;
            }
        } else {
            array_push($_SESSION['errors'], "* Image type is not the correct (We only accept png/jpeg/jpg)");
            return false;
        }
    }
}

function comprobarTalla($talla)
{

    if ($talla == "xs" || $talla == "s" || $talla == "m" || $talla == "l" || $talla == "xl" || $talla == "xxl" || $talla == "xxxl") {
        return true;
    }

    array_push($_SESSION['arrayErrorsAfegirCarrito'], "Please choose the size correctly");

    return false;
}

function comprobarQuantitat($quantitat)
{

    if (is_int($quantitat)) {
        return true;
    }

    array_push($_SESSION['arrayErrorsAfegirCarrito'], "Please specify the quantity you want to buy correctly");

    return false;
}

function comprobarQuantitat2($quantitat)
{

    if (is_int($quantitat)) {


        if ($quantitat <= 0) {

            array_push($_SESSION['arrayErrorsAfegirCarrito'], "Quantity must be bigger than 0.");

            return false;

        } else {

            return true;
        }


    }

    array_push($_SESSION['arrayErrorsAfegirCarrito'], "Please specify the quantity you want to buy correctly");

    return false;
}


function comprovaDni($dni)
{
    $letra = strtoupper(substr($dni, -1));
    $numeros = substr($dni, 0, -1);
    if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros % 23, 1) == $letra && strlen($letra) == 1 && strlen($numeros) == 8) {
        return false;
    } else {
        return true;
    }
}


?>









































