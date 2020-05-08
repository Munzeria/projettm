

<?php 



	include 'connexion.php';
	// appel de la méthode de connexion contenue dans "connexion.php"
	$bdd=connectDB("localhost","cinema","root","");

	// récupération des séances 
	$horaire=$_GET['horaire'];
	$salle=$_GET['salle'];

	$req = "select capacite-(select count(*) from ticket where idsalle=2 and horaire='$horaire') as 'nbTicketAvailable' from salle where idSalle='$salle'";
	readDB($bdd,$req);



?>