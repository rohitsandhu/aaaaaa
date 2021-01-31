<?php
include "../classes/Producte.php";
session_start();



?>



<?php

if (isset($_SESSION['productes'])):


foreach ($_SESSION['productes'] as $v):?>

    <div class="col-lg-4 col-md-6 mb-4 mt-3">
        <div class="card h-100 shadow rounded">
            <a href="detallProducte.php?idProducte=<?php echo $v->getIdProducte();?>"><img class="card-img-top responsive " src="<?php echo $v->getLinkImatge();?>" alt=""></a>
            <div class="card-body">
                <h4 class="card-title costum-product-title">
                    <a href="detallProducte.php?idProducte=<?php echo $v->getIdProducte();?>"><?php echo $v->getNom();?></a>
                </h4>
                <a href="detallProducte.php?idProducte=<?php echo $v->getIdProducte();?>" class="card-link">  <p class="card-text custom-description">
                    <?php echo $v->getDescripcio();?>
                </p></a>
                <a href="detallProducte.php?idProducte=<?php echo $v->getIdProducte();?>"> <p class="mt-1"> <strong> <?php echo $v->getPreu() . "€";?></strong></p> </a>

            </div>

        </div>
    </div>
<?php endforeach;

endif;
?>