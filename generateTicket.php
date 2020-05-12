<?php 
	include 'connexion.php';
	require('fpdf/fpdf.php');
	
	$idTicket=$_GET['idTicket'];
	
	$bdd = connectDB("localhost","cinema","root","");
	
	$req = "select ticket.idSalle, DATE_FORMAT(ticket.horaire,'%e/%c/%Y %H:%i:%S') as 'horaire', film.titre, userInformation.nom, userInformation.prenom, ticket.tarif, genre.libelle 
			from ticket inner join projection using(idSalle,horaire) inner join genre using (idGenre) inner join film using (idFilm) inner join userInformation using(username) where idTicket='$idTicket';";
	
	$data = traitementReadDB($bdd,$req);
	
	$pdf = new FPDF('L','mm','A4');
	$pdf->AddPage();
	$pdf->Image('img/ticket.png',50,5,200);
	
	$pdf->rect(5,15,287,175);
	$pdf->SetFont('Courier','BU',40);
	$pdf->setXY(7,30);
	$pdf->Cell(0,0,"Salle ".$data["idSalle"]." - ".$data["horaire"],0,2,'L');
	$pdf->setXY(7,55);
	$pdf->SetFont('Arial','B',40);
	$pdf->MultiCell(0,25,$data["titre"],0,'L');
	$pdf->SetFont('Courier','',15);
	$pdf->setXY(7,135);
	$pdf->MultiCell(250,10,$data["nom"]." ".$data["prenom"],0,'L');
	$pdf->setXY(7,175);
	$pdf->Cell(0,10, "Tarif : ".substr($data["tarif"],5)." - ".$data["libelle"]);
	$pdf->Cell(0,10,"12345678",0,1,'R');
	$pdf->Output();
	?>

?>