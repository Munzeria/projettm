<?php 
	include '../connexion.php';
	
	$idTicket=$_POST['idTicket'];
	
	$bdd = connectDB("localhost","cinema","root","");
	
	$req = "select ticket.idTicket, ticket.idSalle, DATE_FORMAT(ticket.horaire,'%e/%c/%Y %H:%i:%S') as 'horaire', film.titre, userInformation.nom, userInformation.prenom, ticket.tarif, genre.libelle 
			from ticket inner join projection using(idSalle,horaire) inner join genre using (idGenre) inner join film using (idFilm) inner join userInformation using(username) where idTicket='$idTicket';";
	
	readDB($bdd,$req);
?>
