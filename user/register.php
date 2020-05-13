<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
	<script type="text/javascript" src="../jquery-3.4.1.js"></script>
	<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
	<link type="text/css" rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<link href="logincss.css" rel="stylesheet">
	<script type="text/javascript">
	//fonction pour limiter le nombre de caractères entrés dans un input
		function MaxLengthText(input,maxlength){
		  if (input.value.length > maxlength) {
			input.value = input.value.substring(0, maxlength);
			alert('Votre texte ne doit pas dépasser '+maxlength+' caractères!');
		   }
		}

		function setValues(username,prenom,nom,adresse,ville,codepostal,telephone){
			document.getElementById("inputUsername").value=username;
			document.getElementById("inputPrenom").value=prenom;
			document.getElementById("inputNom").value=nom;
			document.getElementById("inputAdresse").value=adresse;
			document.getElementById("inputVille").value=ville;
			document.getElementById("inputCP").value=codepostal;
			document.getElementById("inputTelephone").value=telephone;
		}

		$(document).ready(function(){
			$("#retour").click(function(event) {	
				window.location.replace("../index.php");
			});
		});

	</script>
</head>
<body>
	<?php

		include '../connexion.php';
		$conn = connectDB("localhost","cinema","root","");
			$free['free']=1;
			if (isset($_POST['username'])){
				$username=$_POST['username'];
				$free = traitementReadDB($conn,"select count(*) as 'free' from userInformation where username='$username'");
			}
		if ($free['free']==0){
			$username=$_POST['username'];
			$password=$_POST['password'];
			$prenom=addslashes($_POST['prenom']);
			$nom=addslashes($_POST['nom']);
			$adresse=addslashes($_POST['adresse']);
			$ville=addslashes($_POST['ville']);
			$codepostal=$_POST['codepostal'];
			$telephone=$_POST['telephone'];


			$req ="insert into userInformation(username,password,nom,prenom,addresse,cp,ville,tel) values ('$username','".hash('sha256', $password)."','$nom','$prenom','$adresse','$codepostal','$ville','$telephone')";
			// Exécuter la requête sur la base de données
			$res = writeDB($conn,$req);
			
			if($res){
				echo "<div class='sucess'>
				<h3>Vous êtes inscrit avec succès.</h3>
				<p>Cliquez ici pour vous <a href='loginUser.php'>connecter</a></p>
				</div>";
			}
		}else{
	?>
	<form class="box container-sm sm-1 form-signin" action="" method="post" name="register">
	
		<nav class="navbar navbar-light bg-light">
			<span class="navbar-brand mb-0 h1">Inscription</span>
			<input value="Accueil" id="retour" class="btn btn-sm btn-secondary">	
		</nav>

		<div id="alert"></div>
	
		<label for="inputUsername" >Nom d'utilisateur</label>
		<input type="text" id="inputUsername" class="box-input form-control" name="username" placeholder="Nom d'utilisateur" required onkeyup="MaxLengthText(this,50);">
		<label for="inputPassword" >Mot de passe</label>
		<input type="password" id="inputPassword" class="box-input form-control" name="password" placeholder="Mot de passe" required onkeyup="MaxLengthText(this,100);">
		<label for="inputPrenom" >Prénom</label>
		<input type="text" id="inputPrenom" class="box-input form-control" name="prenom" placeholder="Prénom" required onkeyup="MaxLengthText(this,150);">
		<label for="inputNom" >Nom</label>
		<input type="text" id="inputNom" class="box-input form-control" name="nom" placeholder="Nom" required onkeyup="MaxLengthText(this,150);">
		<label for="inputAdresse" >Rue et numéro</label>
		<input type="text" id="inputAdresse" class="box-input form-control" name="adresse" placeholder="Rue et numéro" required onkeyup="MaxLengthText(this,150);">
		<label for="inputVille" >Ville</label>
		<input type="text" id="inputVille" class="box-input form-control" name="ville" placeholder="Ville" required onkeyup="MaxLengthText(this,100);">
		<label for="inputCP" >Code postal</label>
		<input type="text" id="inputCP" class="box-input form-control" name="codepostal" placeholder="Code postal" required onkeyup="MaxLengthText(this,6);">
		<label for="inputTelephone" >Téléphone</label>
		<input type="tel" id="inputTelephone" class="box-input form-control" name="telephone" placeholder="Téléphone" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" required onkeyup="MaxLengthText(this,50);">
		
		
	   <div class="container"> <input type="submit" value="Inscription" name="submit" class="box-button btn btn-success float-right"></div>
		<p class="box-register">Déjà inscrit? <a href="loginUser.php">Connectez-vous ici</a></p>
	</form>

	<?php
	if (isset($_POST['username'])){
		$username=$_POST['username'];
		$prenom=$_POST['prenom'];
		$nom=$_POST['nom'];
		$adresse=$_POST['adresse'];
		$ville=$_POST['ville'];
		$codepostal=$_POST['codepostal'];
		$telephone=$_POST['telephone'];
		echo 
		"<script>".
			"$('#alert').append(\"<div class='alert alert-danger'>Username indisponilbe</div>\");".
			"setValues('$username','$prenom','$nom','$adresse','$ville','$codepostal','$telephone');".
		"</script>";
	}
	} ?>
</body>
</html>