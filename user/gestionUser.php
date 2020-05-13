

<?php
	include '../connexion.php';
	
	if (isset($_REQUEST['myFunction']) && $_REQUEST['myFunction'] != '')
	{
		$_REQUEST['myFunction']($_REQUEST);
	}
	
	function getUser($data){
		$bdd=connectDB("localhost","cinema","root","");
		$username=$data['myParams']['username'];
		// echo $username;
		$req="select * from userInformation where username='$username'";
		readDB($bdd,$req);
	}
	
	function connexionUser(){
		session_start();
		
		$conn = connectDB("localhost","cinema","root","");
		
		if (isset($_SESSION['username'])){
			echo trim($_SESSION["username"]);
		}
		else{
			echo false;
			exit(); 
		}
	}
	
	function updateUser($data){
		$username=$data['myParams']['username'];
		$mdp=$data['myParams']['mdp'];
		$nom=$data['myParams']['nom'];
		$prenom=$data['myParams']['prenom'];
		$adresse=$data['myParams']['adresse'];
		$cp=$data['myParams']['cp'];
		$ville=$data['myParams']['ville'];
		$tel=$data['myParams']['tel'];
		
		
		$conn = connectDB("localhost","cinema","root","");
		
		$req="update userInformation set password='".hash('sha256', $mdp)."', nom='$nom', prenom='$prenom', addresse='$adresse', cp='$cp', ville='$ville', tel='$tel' where username='$username'";
		writeDB($bdd,$req);
	}
	
	function getTicketsUser($data){
		$username=$data['myParams']['username'];

		$bdd = connectDB("localhost","cinema","root","");
		
		$req="select ticket.idTicket as 'id', DATE_FORMAT(ticket.horaire,'%e/%c/%Y %H:%i:%S') as 'horaire', ticket.idSalle as 'salle', ticket.tarif as 'tarif' , film.titre as 'film', genre.libelle as 'genre' from ticket inner join projection using(horaire,idSalle) inner join film using(idFilm) inner join genre using(idGenre) where ticket.username='$username' ";
		readDB($bdd,$req);	

	}
	
	function addMoney($data){
		$username=$data['myParams']['username'];
		$argent=$data['myParams']['argent'];

		$bdd = connectDB("localhost","cinema","root","");
		
		$req="update userInformation set argent=argent+'$argent' where username='$username'";
		writeDB($bdd,$req);
	}
?>