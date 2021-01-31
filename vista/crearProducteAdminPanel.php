<?php
include '../classes/Usuari.php';
include '../classes/Conexio.php';
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

if (isset($_GET['noCreat'])){
    $_SESSION['nom'] = $_SESSION['nom'] ?? "";
    $_SESSION['descripcio'] =$_SESSION['descripcio'] ?? "";
    $_SESSION['categoria'] = $_SESSION['categoria'] ?? "";
    $_SESSION['sexe'] = $_SESSION['sexe'] ?? "";
    $_SESSION['preu'] = $_SESSION['preu'] ?? "";
//    $_SESSION['quantitat'] = $_SESSION['quantitat'] ?? "";
//    $_SESSION['talla'] = $_SESSION['talla'] ?? "";

    $_SESSION['xs'] = $_SESSION['xs'] ?? "";
    $_SESSION['s'] = $_SESSION['s'] ?? "";
    $_SESSION['m'] = $_SESSION['m'] ?? "";
    $_SESSION['l'] = $_SESSION['l'] ?? "";
    $_SESSION['xl'] = $_SESSION['xl'] ?? "";
    $_SESSION['xxl'] = $_SESSION['xxl'] ?? "";
    $_SESSION['xxxl'] = $_SESSION['xxxl'] ?? "";

}else{
    $_SESSION['nom'] = "";
    $_SESSION['descripcio'] = "";
    $_SESSION['categoria'] = "";
    $_SESSION['sexe'] = "";
    $_SESSION['preu'] = "";
    $_SESSION['xs'] = "";
    $_SESSION['s'] = "";
    $_SESSION['m'] = "";
    $_SESSION['l'] = "";
    $_SESSION['xl'] = "";
    $_SESSION['xxl'] = "";
    $_SESSION['xxxl'] = "";
}


?>

<!doctype html>
<html lang="en-es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Create Product </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Commissioner:wght@300&display=swap" rel="stylesheet">
    <link rel="icon" href="../styles/img/logoBotiga.png">
    <link rel="stylesheet" href="../styles/css/styles.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg  navbar-light bg-light">
        <a href="../index.php" class="navbar-brand" style=" margin='10px'">
            <img src="../styles/img/logoBotiga.png"  height="50" alt="" /></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul  class="navbar-nav text-uppercase mr-auto">
                <li class="nav-item mr-auto">
                    <a class="btn-light btn"  href="../vista/adminPanel.php"> Manage ranks </a>
                </li>
                <li class="nav-item mr-auto">
                    <a class="btn-light btn" href="../vista/deleteUserAdminPanel.php"> Delete users </a>
                </li>
                <li class="nav-item mr-auto">
                    <a class="btn-light btn" style="color: #6f42c1" href="crearProducteAdminPanel.php"> Create product </a>
                </li>
                <li class="nav-item mr-auto">
                    <a class="btn-light btn"  href="modificarProducteAdminPanel.php"> Modify Product </a>
                </li>
            </ul>
            <li class="nav-item dropdown ml-auto">
                <a class="btn-light btn" href="../index.php?logout=true">Log Out</a>
            </li>
        </div>
    </nav>
    <?php if (isset($_SESSION['producteCreat'])){ ?>
        <div class="alert alert-success alert-dismissible fade show mb-5" role="alert" style="position:absolute; width: 100%; text-align: center" >
            <strong>Product created successfully</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION['producteCreat']);  }?>

    <div class="container mt-5">
        <form method="post" enctype="multipart/form-data" action="../controller/crearProducte.php">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="nom">Product Name</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $_SESSION['nom'];?>" placeholder="Product name..">
                </div>
                <div class="form-group col-md-12">
                    <label for="descripcio">Product description</label>
                    <textarea name="descripcio" class="form-control" id="descripcio"   placeholder="Product desciption.."><?php echo $_SESSION['descripcio'];?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="categoria">Category</label>
                <select class="form-control" name="categoria" id="categoria">
                    <option  <?php if ($_SESSION['categoria']=="shirt"){
                        echo "selected";
                    }?>  value="shirt"> Shirts </option>
                    <option <?php if ($_SESSION['categoria']=="tshirt"){
                        echo "selected";
                    }?>  value="tshirt"> T-shirts </option>
                    <option <?php if ($_SESSION['categoria']=="jeans"){
                        echo "selected";
                    }?>  value="jeans"> Jeans </option>
                    <option <?php if ($_SESSION['categoria']=="jackets"){
                        echo "selected";
                    }?>  value="jackets"> Jackets </option>
                    <option <?php if ($_SESSION['categoria']=="sweaters"){
                        echo "selected";
                    }?>  value="sweaters"> Sweaters </option>
                </select>
            </div>

            <style>
                .label-custom{
                    width: 50px;
                }
            </style>


            <div class="form-group">
                <p>
                    Quantity per size
                </p>
            </div>

            <div class="form-row">

                <div class="form-group col-md-2">
                    <label class="label-custom" >XS</label>
                    <input id="xs" name="xs" type="number"  placeholder="Quantity"  value="<?php echo $_SESSION['xs']; ?>"   class="form-control" >
                </div>
                <div class="form-group col-md-2">
                    <label class="label-custom"  >S</label>
                    <input id="s" name="s" type="number" placeholder="Quantity"   value="<?php echo $_SESSION['s']; ?>"   class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label  class="label-custom" >M</label>
                    <input id="m" name="m" type="number"   placeholder="Quantity"  value="<?php echo $_SESSION['m']; ?>"   class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label class="label-custom"  >L</label>
                    <input id="l" name="l" type="number"  placeholder="Quantity"  value="<?php echo $_SESSION['l']; ?>"  class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label  class="label-custom" >XL</label>
                    <input id="xl" name="xl" type="number" placeholder="Quantity"  value="<?php echo $_SESSION['xl']; ?>"  class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label  class="label-custom" >XXL</label>
                    <input id="xxl" name="xxl" type="number" placeholder="Quantity"    value="<?php echo $_SESSION['xxl']; ?>"  class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label  class="label-custom" >XXXL</label>
                    <input id="xxxl" name="xxxl" type="number" placeholder="Quantity"    value="<?php echo $_SESSION['xxxl']; ?>"  class="form-control">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="sexe">Is for...</label>
                    <select class="form-control" name="sexe"  id="sexe">
                        <option   <?php if ( $_SESSION['sexe']=="home"){
                            echo "selected";
                        }?>    selected value="home"> Men </option>
                        <option   <?php if ( $_SESSION['sexe']=="dona"){
                            echo "selected";
                        }?>    value="dona"> Women </option>
                        <option   <?php if ( $_SESSION['sexe']=="unisex"){
                            echo "selected";
                        }?>    value="unisex"> Unisex </option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="preu">Price</label>
                    <input type="number" step="any"  min="0.1" id="preu" name="preu"  value="<?php echo $_SESSION['preu'];?>"  placeholder="ex(1,2,3...100)" class="form-control">
                </div>
<!--                <div class="form-group col-md-2 ">-->
<!--                    <label for="quantitat">Quantity</label>-->
<!--                    <input type="number" min="0" class="form-control" name="quantitat" id="quantitat"  value="--><?php //echo $_SESSION['quantitat'];?><!--"  placeholder="ex(1,2,3...100)">-->
<!--                </div>-->
            </div>
            <div class="form-group">
                <label for="uploadFile">Image file</label>
                <input type="file" class="form-control" name="uploadFile" id="uploadFile" enctype="multipart/form-data">
            </div>
            <input type="submit" name="enviar" class="btn btn-secondary" value="Create">
        </form>
    </div>

    <div class="container mt-2" style="text-align: center; background-color: #fc5a4e">
        <?php if (isset($_SESSION['producteNoCreat'])){ ?>
                <strong> Could not create product </strong><br>
                <?php for ($i = 0; $i<count($_SESSION['errors']); $i++){ ?>
                    <p> <?php echo $_SESSION['errors'][$i] ;?> </p>
                <?php }?>
        <?php unset($_SESSION['producteNoCreat']);  }?>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
