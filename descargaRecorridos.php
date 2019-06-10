<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 10/03/2019
 * Time: 20:23
 */


require "ftpd/fpdf/fpdf.php";
session_start();
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->setX(50);
$pdf->Cell(100,10,$_SESSION['tituloRecorrido'],1,1,"C");
$pdf->setY(30);
$i=1;
foreach ($_SESSION['puntosInteres'] as $ptoInteres){

    $pdf->Cell(1000,10,"Punto de interes ".$i.": ".iconv('UTF-8', 'windows-1252', $ptoInteres["titulo"]),0,1,"L");
    $i++;
}
$pdf->Output();

?>