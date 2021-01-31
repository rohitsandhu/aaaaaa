<?php
include '../classes/Usuari.php';
include '../classes/Conexio.php';
include '../classes/Producte.php';
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$con = new Conexio();

if(!isset($_SESSION['usuariLogged'])){
    header('Location: ../index.php');
}else{
    if ($_SESSION['usuariLogged']->getRol()==2){
        header('Location: ../index.php');
    }
}

if (isset($_GET['idProducteAModificar'])){
    $con->openConnection();
    $_SESSION['producteActual']= $con->getProductePerID($_GET['idProducteAModificar']);
    $con->closeConnection();


}
$_SESSION['producteActual'] = $_SESSION['producteActual'] ?? "";


?>

<!doctype html>
<html lang="en-es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Modify </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Commissioner:wght@300&display=swap" rel="stylesheet">
    <link rel="icon" href="../styles/img/logoBotiga.png">
    <link rel="stylesheet" href="../styles/css/styles.css">
</head>
<body>

<div class="container mt-5">
    <form method="post" enctype="multipart/form-data" action="../controller/modificarElProducte.php">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="nom">Product Name (Optional)</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $_SESSION['producteActual']->getNom();?>" placeholder="Product name..">
            </div>
            <div class="form-group col-md-12">
                <label for="descripcio">Product description (Optional)</label>
                <textarea name="descripcio" class="form-control" id="descripcio"   placeholder="Product desciption.."><?php echo $_SESSION['producteActual']->getDescripcio();?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="categoria">Category (Optional)</label>
            <select class="form-control" name="categoria" id="categoria">
                <option <?php if ($_SESSION['producteActual']->getCategoria()=="Shirts"){
                    echo "selected";
                }?> value="shirt"> Shirts </option>
                <option <?php if ($_SESSION['producteActual']->getCategoria()=="tshirt"){
                    echo "selected";
                }?> value="tshirt"> T-shirts </option>
                <option <?php if ($_SESSION['producteActual']->getCategoria()=="jeans"){
                    echo "selected";
                }?> value="jeans"> Jeans </option>
                <option <?php if ($_SESSION['producteActual']->getCategoria()=="jackets"){
                    echo "selected";
                }?> value="jackets"> Jackets </option>
                <option <?php if ($_SESSION['producteActual']->getCategoria()=="sweaters"){
                    echo "selected";
                }?> value="sweaters"> Sweaters </option>
            </select>
        </div>

        <div class="form-group">
            <p>
                Quantity per size (Optional)
            </p>
        </div>
        <div class="form-row">

            <div class="form-group col-md-2">
                <label class="label-custom" >XS</label>
                <input id="xs" name="xs" type="number"  placeholder="Quantity"  value="<?php echo $_SESSION['producteActual']->getArrayTalles()['xs']; ?>"   class="form-control" >
            </div>
            <div class="form-group col-md-2">
                <label class="label-custom"  >S</label>
                <input id="s" name="s" type="number" placeholder="Quantity"   value="<?php echo $_SESSION['producteActual']->getArrayTalles()['s']; ?>"   class="form-control">
            </div>
            <div class="form-group col-md-2">
                <label  class="label-custom" >M</label>
                <input id="m" name="m" type="number"   placeholder="Quantity"  value="<?php echo $_SESSION['producteActual']->getArrayTalles()['m']; ?>"   class="form-control">
            </div>
            <div class="form-group col-md-2">
                <label class="label-custom"  >L</label>
                <input id="l" name="l" type="number"  placeholder="Quantity"  value="<?php echo $_SESSION['producteActual']->getArrayTalles()['l']; ?>"  class="form-control">
            </div>
            <div class="form-group col-md-2">
                <label  class="label-custom" >XL</label>
                <input id="xl" name="xl" type="number" placeholder="Quantity"  value="<?php echo $_SESSION['producteActual']->getArrayTalles()['xl']; ?>"  class="form-control">
            </div>
            <div class="form-group col-md-2">
                <label  class="label-custom" >XXL</label>
                <input id="xxl" name="xxl" type="number" placeholder="Quantity"    value="<?php echo $_SESSION['producteActual']->getArrayTalles()['xxl']; ?>"  class="form-control">
            </div>
            <div class="form-group col-md-2">
                <label  class="label-custom" >XXXL</label>
                <input id="xxxl" name="xxxl" type="number" placeholder="Quantity"    value="<?php echo $_SESSION['producteActual']->getArrayTalles()['xxxl']; ?>"  class="form-control">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="sexe">Is for...  (Optional)</label>
                <select class="form-control" name="sexe"  id="sexe">
                    <option <?php if ($_SESSION['producteActual']->getSexe()=="home"){
                        echo "selected";
                    }?> selected value="home"> Men </option>
                    <option <?php if ($_SESSION['producteActual']->getSexe()=="dona"){
                        echo "selected";
                    }?> value="dona"> Women </option>
                    <option <?php if ($_SESSION['producteActual']->getSexe()=="unisex"){
                        echo "selected";
                    }?> value="unisex"> Unisex </option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="preu">Price (Optional)</label>
                <input type="number" step="any"  min="0.1" id="preu" name="preu"  value="<?php echo $_SESSION['producteActual']->getPreu();?>"  placeholder="ex(1,2,3...100)" class="form-control">
            </div>
        </div>
        <div>
            <h6> Current product image</h6>
            <img src="<?php echo $_SESSION['producteActual']->getLinkImatge();?>" width="200" alt="">
        </div>
        <div class="form-group">
            <label for="uploadFile">New Image (Optional)</label>
            <input type="file" class="form-control" name="uploadFile" id="uploadFile" enctype="multipart/form-data">
        </div>
        <input type="button" name="cancel" onclick="location.href='modificarProducteAdminPanel.php';"  class="btn btn-light" value="Cancel">
        <input type="submit" name="modify" class="btn btn-success"  value="Modify">
    </form>
</div>

<div class="container mt-2" style="text-align: center; background-color: #fc5a4e">
    <?php if (isset($_SESSION['producteNoModificat'])){ ?>
        <strong> Could not modify the product </strong><br>
        <?php

        if ($_SESSION['errors']!=null){

        for ($i = 0; $i<count($_SESSION['errors']); $i++){ ?>

            <p> <?php echo $_SESSION['errors'][$i] ;?> </p>
        <?php }?>
        <?php unset($_SESSION['producteNoModificat']);
        }
    }?>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
