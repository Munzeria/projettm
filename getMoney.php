<?php 



	include 'connexion.php';
	// appel de la méthode de connexion contenue dans "connexion.php"
	$bdd=connectDB("localhost","cinema","root","");

	// récupération des séances 
	$username=$_POST['username'];

	$req = "select argent from userInformation where username='$username'";
	readDB($bdd,$req);



?>