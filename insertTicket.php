<?php
	include 'connexion.php';

	$bdd=connectDB("localhost","cinema","root","");
	
	$horaire=$_POST['horaire'];
	$idSalle=$_POST['idSalle'];
	$username=$_POST['username'];
	$tarif=$_POST['tarif'];
	
	$req = "insert into ticket (horaire,idSalle,username,tarif) values ('$horaire','$idSalle','$username','$tarif')";
	$exec = writeDB($bdd,$req);
?>