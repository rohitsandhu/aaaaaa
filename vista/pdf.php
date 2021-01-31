<?php
include '../classes/LiniaComanda.php';
include '../classes/Comanda.php';
include '../classes/Usuari.php';
include '../classes/Producte.php';
include '../classes/Conexio.php';

require('PDF2.php');
session_start();

$pdf = new PDF2();
$pdf->AddPage();

$pdf->SetTitle('Order-'.$_GET['idComanda']."-".$_SESSION['usuariLogged']->getNom()." ".$_SESSION['usuariLogged']->getCognoms());

$pdf->SetY(18);
$pdf->SetFont('Arial', 'B' ,50);
$pdf->Cell(0 , 10 , 'Bill' , 0 , 1, 'L');
$pdf->Ln();

$con = new Conexio();


$pdf->Image('../styles/img/logoBotiga.png' , $pdf->GetPageWidth()-90 , 5 , 90, 40);

$pdf->SetY(50);
$pdf->SetFont('Arial' , 'BI' , 18);
$pdf->Cell($pdf->GetPageWidth()/2.4 , 7 , utf8_decode('SHOP') , 0 , 0 , 'L' , false ,  "../");
$pdf->Cell($pdf->GetPageWidth()/2.4 , 7 , utf8_decode('CLIENT') , 0 , 0 , 'R' , false);
$pdf->Ln();
$pdf->SetFont('Arial' , 'BI' , 12);
$pdf->Cell($pdf->GetPageWidth()/2.4 , 7 , utf8_decode('Rohit The Chief') , 0 , 0 , 'L');
$pdf->Cell($pdf->GetPageWidth()/2.4 , 7 , utf8_decode(($_SESSION['usuariLogged']->getNom())." ".($_SESSION['usuariLogged']->getCognoms())) , 0 , 0 , 'R');
$pdf->Ln();
$pdf->Cell($pdf->GetPageWidth()/2.4 , 7 , utf8_decode('shoppushop@prova.com') , 0 , 0 , 'L');
$pdf->Cell($pdf->GetPageWidth()/2.4 , 7 , utf8_decode($_SESSION['usuariLogged']->getCorreu()) , 0 , 0 , 'R');
$pdf->Ln();
$pdf->Cell($pdf->GetPageWidth()/2.4 , 7 , utf8_decode('Carrer xd nº99, Spain') , 0 , 0 , 'L');
$pdf->Cell($pdf->GetPageWidth()/2.4 , 7 , utf8_decode($_SESSION['usuariLogged']->getDni()) , 0 , 0 , 'R');
$pdf->Ln();
$pdf->Cell($pdf->GetPageWidth()/2.4 , 7 , utf8_decode('') , 0 , 0 , 'L');
$pdf->Cell($pdf->GetPageWidth()/2.4 , 7 , utf8_decode($_SESSION['usuariLogged']->getAdreça()) , 0 , 0 , 'R');
$pdf->Ln();
$pdf->Ln();
$pdf->Cell($pdf->GetPageWidth()/2.4 , 7 , utf8_decode('Comanda ID: '.$_GET['idComanda']) , 0 , 0 , 'L');

$con->openConnection();
$hora = $con->getHoraCompraByID($_GET['idComanda']);
$con->closeConnection();

$pdf->Cell($pdf->GetPageWidth()/2.4 , 7 , utf8_decode('Time of purchase: '.$hora) , 0 , 0 , 'R');

$header = array('Product' , 'Quantity' , 'Indv. Price' , 'Total');

$con->openConnection();
if (isset($_GET['idComanda'])){
    $data = $con->getLiniasComandaPerIdUsuariAndIdComandaPerElPDF($_SESSION['usuariLogged']->getIdUsuari(),$_GET['idComanda']);
    $con->closeConnection();

    $pdf->Ln();
    $pdf->ImprovedTable($header,$data);

    $pdf->Output('I' , 'Order-'.$_GET['idComanda']."-".$_SESSION['usuariLogged']->getNom()." ".$_SESSION['usuariLogged']->getCognoms());
}else{

}
