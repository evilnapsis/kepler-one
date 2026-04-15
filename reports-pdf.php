<?php
include "core/autoload.php";
include "core/app/autoload.php";
require('fpdf/fpdf.php');

if(isset($_GET["product_id"]) && isset($_GET["sd"]) && isset($_GET["ed"])){
    $product = ProductData::getById($_GET["product_id"]);
    $sd = strtotime($_GET["sd"]);
    $ed = strtotime($_GET["ed"]);

    if(!$product){
        die("Producto no encontrado.");
    }

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(0,10, utf8_decode('Reporte de Inventario'), 0, 1, 'C');
    $pdf->Ln(5);
    
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(0,10, utf8_decode('Producto: ').utf8_decode($product->name), 0, 1);
    $pdf->Cell(0,10, utf8_decode('Rango de fechas: ').$_GET["sd"]." a ".$_GET["ed"], 0, 1);
    $pdf->Ln(5);

    // Table Header
    $pdf->SetFont('Arial','B',10);
    $pdf->SetFillColor(230,230,230);
    $pdf->Cell(45,7,'Fecha',1, 0, 'C', true);
    $pdf->Cell(45,7,'Entradas',1, 0, 'C', true);
    $pdf->Cell(45,7,'Salidas',1, 0, 'C', true);
    $pdf->Cell(45,7,'Diferencia',1, 0, 'C', true);
    $pdf->Ln();

    $pdf->SetFont('Arial','',10);
    $intotal=0;
    $outtotal = 0;
    
    for($i=$sd;$i<=$ed;$i+=(60*60*24)){
        $in = OperationData::sumByPKD($_GET["product_id"],1,date("Y-m-d",$i));
        $out = OperationData::sumByPKD($_GET["product_id"],2,date("Y-m-d",$i));
        
        $val_in = ($in->s != null) ? $in->s : 0;
        $val_out = ($out->s != null) ? $out->s : 0;
        $diff = $val_in - $val_out;
        
        $pdf->Cell(45,7,date("Y-m-d",$i),1);
        $pdf->Cell(45,7,number_format($val_in,2),1, 0, 'R');
        $pdf->Cell(45,7,number_format($val_out,2),1, 0, 'R');
        $pdf->Cell(45,7,number_format($diff,2),1, 0, 'R');
        $pdf->Ln();
        
        $intotal+= $val_in;
        $outtotal+= $val_out;
    }
    
    $pdf->SetFont('Arial','B',10);
    $pdf->SetFillColor(230,230,230);
    $pdf->Cell(45,7,'TOTAL',1, 0, 'C', true);
    $pdf->Cell(45,7,number_format($intotal,2),1, 0, 'R', true);
    $pdf->Cell(45,7,number_format($outtotal,2),1, 0, 'R', true);
    $pdf->Cell(45,7,number_format($intotal-$outtotal,2),1, 0, 'R', true);
    $pdf->Ln();

    $pdf->Output();
}else{
    echo "No hay datos suficientes para generar el reporte.";
}
?>
