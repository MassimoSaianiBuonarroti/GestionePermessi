<?php
include 'pagine/accessoDatabase.php';
$con= accesso();
$data_corrente= date("Y-m-d");
$data_corrente_esplosa= explode("-",$data_corrente); 
$Y= $data_corrente_esplosa[0];
$m= $data_corrente_esplosa[1];
$d= $data_corrente_esplosa[2];
$data_visualizzata= $d."-".$m."-".$Y;
$query= "SELECT * FROM permesso WHERE data='".$data_corrente. "' AND stato=0 ORDER BY data";
//echo $query;
$result=mysqli_query($con,$query);
require('fpdf.php');
$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','',20);
$pdf->Cell(20);
$pdf->Cell(60,10,$data_visualizzata,0,0,'C');
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(255,000,000);
$pdf->Cell(20);
$pdf->Cell(60,10,'STUDENTE',1,0,'C');
$pdf->Cell(20,10,'CLASSE',1,0,'C');
$pdf->Cell(20,10,'ORA',1,0,'C');
//$pdf->Cell(80,10,'MOTIVAZIONE',1,0,'C');
$pdf->Cell(60,10,'GENITORE',1,0,'C');
$pdf->Ln();
$pdf->SetTextColor(0);
while($row= mysqli_fetch_array($result)){
    $pdf->Cell(20);
    //$pdf->Ln(1);
    $pdf->Cell(60,10,$row["cognomenomestudente"],1,0,'C');
    $pdf->Cell(20,10,$row["classe"],1,0,'C');
    $pdf->Cell(20,10,$row["orauscita"],1,0,'C');
    //$pdf->Cell(80,10,$row["motivazione"],1,0,'C');
    $pdf->Cell(60,10,$row["cognomenomegenitore"],1,0,'C');
            //$row["classe"]." ".
            //$row["orauscita"]." ".
            //$row["motivazione"]." ".
            //$row["cognomenomegenitore"],0,1,'C');
    $pdf->Ln();
}

$pdf->Output();
?>