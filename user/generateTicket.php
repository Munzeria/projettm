<?php
	require('../fpdf/fpdf.php');
	
	$json=$_GET['json'];
	
	$data = json_decode($json);
	
	
	$pdf = new FPDF('L','mm','A4');
	$pdf->AddPage();
	$pdf->Image('../img/ticket.png',50,5,200);
		
	$pdf->rect(5,15,287,175);
	$pdf->SetFont('Courier','BU',40);
	$pdf->setXY(7,30);
	$pdf->Cell(0,0,"Salle ".$data[0]->{'idSalle'}." - ".$data[0]->{'horaire'},0,2,'L');
	$pdf->setXY(7,55);
	$pdf->SetFont('Arial','B',40);
	$pdf->MultiCell(0,25,$data[0]->{'titre'},0,'L');
	$pdf->SetFont('Courier','',15);
	$pdf->setXY(7,135);
	$pdf->MultiCell(250,10,$data[0]->{'nom'}." ".$data[0]->{'prenom'},0,'L');
	$pdf->setXY(7,175);
	$pdf->Cell(0,10, "Tarif : ".substr($data[0]->{'tarif'},5)." - ".$data[0]->{'libelle'});
	$pdf->Cell(0,10,$data[0]->{'idTicket'},0,1,'R');
	$pdf->Output('D','ticket_'.$data[0]->{'idTicket'}.'.pdf');
?>