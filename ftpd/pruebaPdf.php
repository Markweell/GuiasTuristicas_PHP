<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 10/03/2019
 * Time: 17:57
 */
require "fpdf/fpdf.php";
header('Content-Type: text/html; charset=utf-8');
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(100,10,'Guias Turisticas',1,1,"C");
$pdf->Output();
?>

