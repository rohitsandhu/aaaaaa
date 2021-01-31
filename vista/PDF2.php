<?php
require('../pdfs/fpdf.php');

class PDF2 extends FPDF
{
    function ImprovedTable($header, $data)
    {
        define('EURO',chr(128));
        $width = $this->GetPageWidth();


        $w = array($width*0.4 , $width*0.15, $width*0.15, $width*0.15);


        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C');
        $this->Ln();


        foreach($data as $row)
        {
            $con = new Conexio();
            $con->openConnection();
            $arr=$con->getProducteNomPreu($row->getIdProducte());
            $con->closeConnection();
            $this->Cell($w[0],6,utf8_decode($arr['nom']),'LBR');

            $this->Cell($w[1],6,number_format($row->getQuantitat()),'LRB' , 0 , 'C');
            $this->Cell($w[2],6,money_format('%i', floatval($arr['preu'])) . EURO,'LRB',0,'C');
            $this->Cell($w[3],6, money_format('%i' , $row->getPreuTotal()) . EURO,'LRB',0,'C');
            $this->Ln();
        }


        $con->openConnection();
        $arr2 = $con->getComandaIvaAndTotal($data[0]->getIdComanda());
        $con->closeConnection();

        $this->Cell($w[0]);
        $this->Cell($w[1]);
        $this->Cell($w[2],8,'Total' , 'B' , 0 , 'C');
        $this->Cell($w[3],8,money_format('%i',floatval($arr2['preuTotal'])) . EURO , 'B' , 0 , 'C');
        $this->Ln();

        $this->Cell($w[0]);
        $this->Cell($w[1]);
        $this->Cell($w[2],8,'Iva (21%)' , 'B' , 0 , 'C');
        $this->Cell($w[3],8,money_format('%i', floatval($arr2['iva'])) . EURO , 'B' , 0 , 'C');
        $this->Ln();

        $this->Cell($w[0]);
        $this->Cell($w[1]);
        $this->Cell($w[2] , 8 , 'Total with iva' , 'B' , 'C');



        $this->Cell($w[3] , 8 , money_format('%i' , (floatval($arr2['iva']) + floatval($arr2['preuTotal'])) ) . EURO , 'B' , 0 , 'C' );
        $this->Ln();

        $this->setFont('Arial' , 'B' , 12);
        $this->SetTextColor(255,0,0);

//        $this->Cell($w[0]);
//        $this->Cell($w[1]);
//        $this->Cell($w[2],8,'Iva (21%)' , 'B' , 0 , 'C');
//        $this->Cell($w[3],8,money_format('%i',16.84) . EURO , 'B' , 0 , 'C');
        $this->Ln();

        $this->Cell(array_sum($w),0,'','T');

    }
}