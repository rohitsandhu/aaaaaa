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

?>
<!doctype html>
<html lang="en-es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Admin Panel</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.22/r-2.2.6/datatables.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/r-2.2.6/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/r-2.2.6/datatables.min.js"></script>

    <link rel="icon" href="../styles/img/logoBotiga.png">
    <link rel="stylesheet" href="../styles/css/styles.css">
</head>
<body style="background-color: white!important;">
<nav class="navbar navbar-expand-lg  navbar-light bg-light">
    <a href="../index.php" class="navbar-brand" style=" margin='10px'">
        <img src="../styles/img/logoBotiga.png"  height="50" alt="" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul  class="navbar-nav text-uppercase mr-auto">
        <li class="nav-item mr-auto">
            <a class="btn-light btn " style="color: #6f42c1" href="../vista/adminPanel.php"> Manage ranks </a>
        </li>
        <li class="nav-item mr-auto">
            <a class="btn-light btn " href="../vista/deleteUserAdminPanel.php"> Delete users </a>
        </li>
        <li class="nav-item mr-auto">
            <a class="btn-light btn " href="crearProducteAdminPanel.php"> Create product </a>
        </li>
        <li class="nav-item mr-auto">
            <a class="btn-light btn"  href="modificarProducteAdminPanel.php"> Modify Product </a>
        </li>
    </ul>
        <li class="nav-item dropdown ml-auto">
            <a class="btn-light btn" href="../index.php?logout=true"> Log Out </a>
        </li>
    </div>
</nav>

<?php if(isset($_SESSION['adminToNoAdmin'])) :?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Successfully changed admin to normal client</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php
    unset($_SESSION['adminToNoAdmin']); endif; ?>

<?php if(isset($_SESSION['noAdminToAdmin'])) :?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Successfully upgraded a client to Admin</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php unset($_SESSION['noAdminToAdmin']); endif; ?>

<?php if(isset($_SESSION['verifyOk'])) :?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>User verified successfully</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php unset($_SESSION['verifyOk']); endif; ?>

<div class="container mt-4">

    <h3>
        RANK MANAGEMENT
    </h3>

</div>

<div class="container mt-5">
    <div class="mb-3"> <h4> Admin users </h4> </div>
    <div class="row">
        <div class="col-12">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>User ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Verified</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $con->openConnection();
                $arrayUsuaris = $con->getAllUsuaris();
                $con->closeConnection();

                for ($i = 0; $i<count($arrayUsuaris);$i++){ ?>
                        <?php  if ($arrayUsuaris[$i]->getRol()==1):?>

                            <tr>
                                <form method="post" action="../controller/cosesAdmin.php">
                                <td name="idUsuari">
                                    <input type="hidden" name="idUser" value="<?php echo $arrayUsuaris[$i]->getIdUsuari(); ?>">
                                    <?php echo $arrayUsuaris[$i]->getIdUsuari(); ?>
                                </td>
                                <td> <?php echo $arrayUsuaris[$i]->getNom()." ".$arrayUsuaris[$i]->getCognoms(); ?> </td>
                                <td> <?php echo $arrayUsuaris[$i]->getCorreu(); ?> </td>
                                <td> <?php echo $arrayUsuaris[$i]->getRol(); ?> </td>
                                <td> <?php echo $arrayUsuaris[$i]->getActivat(); ?> </td>

                                    <?php if ($arrayUsuaris[$i]->getIdUsuari()!=$_SESSION['usuariLogged']->getIdUsuari()): ?>
                                        <td> <input type="submit" class="btn btn-light" name="enviar" style="width: 100%" value="Demote 🡇">  </td>
                                    <?php else: ?>
                                        <td> <?php echo "You"; ?>  </td>
                                    <?php endif; ?>
                                </form>
                            </tr>

                        <?php
                        elseif ($arrayUsuaris[$i]->getRol()==0): ?>
                                <tr>
                                    <td name="idUsuari">
                                        <input type="hidden" value="<?php echo $arrayUsuaris[$i]->getIdUsuari(); ?>">
                                        <?php echo $arrayUsuaris[$i]->getIdUsuari(); ?>
                                    </td>
                                    <td> <?php echo $arrayUsuaris[$i]->getNom()." ".$arrayUsuaris[$i]->getCognoms(); ?> </td>
                                    <td> <?php echo $arrayUsuaris[$i]->getCorreu(); ?> </td>
                                    <td> <?php echo $arrayUsuaris[$i]->getRol(); ?> </td>
                                    <td> <?php echo $arrayUsuaris[$i]->getActivat(); ?> </td>
                                    <td> Owner </td>
                                </tr>
                    <?php endif;?>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="mb-3"> <h4> Normal users </h4> </div>
    <div class="row">
        <div class="col-12">
            <table id="example2" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>User ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Verified</th>
                    <td>Action</td>
                </tr>
                </thead>
                <tbody>
                <?php
                $con->openConnection();
                $arrayUsuaris = $con->getAllUsuaris();
                $con->closeConnection();
                for ($i = 0; $i<count($arrayUsuaris);$i++){ ?>
                    <?php  if ($arrayUsuaris[$i]->getRol()==2 && $arrayUsuaris[$i]->getActivat()==1):?>
                        <tr>
                            <form method="post" action="../controller/cosesAdmin.php">
                                <td name="idUsuari">
                                    <input type="hidden" name="idUser" value="<?php echo $arrayUsuaris[$i]->getIdUsuari(); ?>">
                                    <?php echo $arrayUsuaris[$i]->getIdUsuari(); ?>
                                </td>
                                <td> <?php echo $arrayUsuaris[$i]->getNom()." ".$arrayUsuaris[$i]->getCognoms(); ?> </td>
                                <td> <?php echo $arrayUsuaris[$i]->getCorreu(); ?> </td>
                                <td> <?php echo $arrayUsuaris[$i]->getRol(); ?> </td>
                                <td> <?php echo $arrayUsuaris[$i]->getActivat(); ?> </td>
                                <td> <input type="submit" name="enviar2" style="width: 100%" class="btn btn-light" value="Promote 🡅"> </td>
                            </form>
                        </tr>
                    <?php endif;?>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="mb-3"> <h4> Not verified users </h4> </div>
    <div class="row">
        <div class="col-12">
            <table id="example3" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>User ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Verified</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $con->openConnection();
                $arrayUsuaris = $con->getAllUsuaris();
                $con->closeConnection();

                for ($i = 0; $i<count($arrayUsuaris);$i++){ ?>
                    <?php  if ($arrayUsuaris[$i]->getActivat()==0):?>
                        <tr>
                            <form method="post" action="../controller/cosesAdmin.php">
                                <td name="idUsuari">
                                    <input type="hidden" name="idUser" value="<?php echo $arrayUsuaris[$i]->getIdUsuari(); ?>">
                                    <?php echo $arrayUsuaris[$i]->getIdUsuari(); ?>
                                </td>
                                <td> <?php echo $arrayUsuaris[$i]->getNom()." ".$arrayUsuaris[$i]->getCognoms(); ?> </td>
                                <td> <?php echo $arrayUsuaris[$i]->getCorreu(); ?> </td>
                                <td> <?php echo $arrayUsuaris[$i]->getRol(); ?> </td>
                                <td> <?php echo $arrayUsuaris[$i]->getActivat(); ?> </td>
                                <td> <input type="submit" name="enviar3" style="width: 100%" class="btn btn-light" value="Verify User ✓ "> </td>
                            </form>
                        </tr>
                    <?php endif;?>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<script>
    $(document).ready( function () {
        $('#example')
            .addClass( 'nowrap' )
            .dataTable( {
                responsive: true,
                columnDefs: [
                    { targets: [0, 1], className: 'dt-body-right' }
                ]
            } );
    });

    $(document).ready( function () {
        $('#example2')
            .addClass( 'nowrap' )
            .dataTable( {
                responsive: true,
                columnDefs: [
                    { targets: [0, 1], className: 'dt-body-right' }
                ]
            } );
    });

    $(document).ready( function () {
        $('#example3')
            .addClass( 'nowrap' )
            .dataTable( {
                responsive: true,
                columnDefs: [
                    { targets: [0, 1], className: 'dt-body-right' }
                ]
            } );
    });

</script>


<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>-->
</body>
</html>