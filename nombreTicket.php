

<?php 



	include 'connexion.php';
	// appel de la méthode de connexion contenue dans "connexion.php"
	$bdd=connectDB("localhost","cinema","root","");

	// récupération des séances 
	$horaire=$_POST['horaire'];
	$salle=$_POST['salle'];

	$req = "select capacite-(select count(*) from ticket where idsalle=2 and horaire='$horaire') as 'nbTicketAvailable' from salle where idSalle='$salle'";
	readDB($bdd,$req);



?>