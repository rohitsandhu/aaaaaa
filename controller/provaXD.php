<?php

// $pdfs =getimagesize($_FILES['uploadFile']['tmp_name']);


//if($_SESSION['uploadFile'] == null){
//    echo "sdfsdfsdfsdfsdfsdf";
//}
//echo '<br> <br>';
//
//list($width, $height) = getimagesize($_FILES['uploadFile']['tmp_name']);
//
$_SESSION['uploadFile'] = $_FILES['uploadFile'] ?? "";
//
//var_dump($_SESSION['uploadFile']);
//echo '<br> <br>';
//var_dump($_SESSION['uploadFile']['type']);
////var_dump($width, $height);
//
//
//if($_SESSION['uploadFile']['type'] == "image/png"){
//    echo "sdfsdfsdfsdfsdfsdf";
//}
//
//if($_SESSION['uploadFile'] == null){
//    echo "sdfsdfsdfsdfsdfsdf";
//}

//if($width == 1020){
//    echo "qqqqqqqqqqqqqqq";
//}
//echo '<br> <br>';
//if($height == 510){
//    echo "eeeeeeeeeeeeeee";
//}
//echo '<br> <br>';
//if(abs($width-$height)<1){
//    echo "oooooooooooooo";
//}
//if(abs($width-$height)<1){
//    echo "oooooooooooooo";
//}


echo $_SESSION['uploadFile']['name'];

//header('Location: ../vista/prova.php');