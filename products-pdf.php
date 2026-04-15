<?php
include "core/autoload.php";
include "core/app/autoload.php";
require('fpdf/fpdf.php');

$products = ProductData::getAll();

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10, utf8_decode('Listado de Productos e Inventario'), 0, 1, 'C');
$pdf->Ln(5);

// Table Header
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(230,230,230);
$pdf->Cell(30,7, utf8_decode('Código'), 1, 0, 'C', true);
$pdf->Cell(80,7,'Nombre',1, 0, 'C', true);
$pdf->Cell(30,7,'Precio',1, 0, 'C', true);
$pdf->Cell(40,7,'Existencias',1, 0, 'C', true);
$pdf->Ln();

$pdf->SetFont('Arial','',10);

if(count($products)>0){
    foreach($products as $product){
        $in = OperationData::sumByPK($product->id,1);
        $out = OperationData::sumByPK($product->id,2);
        
        $val_in = ($in->s != null) ? $in->s : 0;
        $val_out = ($out->s != null) ? $out->s : 0;
        $q = $val_in - $val_out;

        $pdf->Cell(30,7, utf8_decode($product->code), 1);
        $pdf->Cell(80,7, utf8_decode($product->name), 1);
        $pdf->Cell(30,7, "$ ".number_format($product->price,2), 1, 0, 'R');
        $pdf->Cell(40,7, number_format($q,2), 1, 0, 'R');
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0,10, utf8_decode('No hay productos registrados.'), 0, 1, 'C');
}

$pdf->Output();
?>
