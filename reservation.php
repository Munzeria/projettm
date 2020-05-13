

<?php 
	include 'connexion.php';	
	// appel de la méthode de connexion contenue dans "connexion.php"
	$bdd=connectDB("localhost","cinema","root","");

	// récupération des séances 
	$genre=$_POST['genre'];

	$req = "SELECT tarifAdulte, tarifEnfant, tarifEtudiant, tarifSenior FROM genre WHERE idGenre= '$genre'";
	readDB($bdd,$req);
?>
