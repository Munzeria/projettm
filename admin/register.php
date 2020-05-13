<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<script type="text/javascript" src="../jquery-3.4.1.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript">
		//fonction pour limiter le nombre de caractères entrés dans un input
		 function MaxLengthText(input,maxlength){
		  if (input.value.length > maxlength) {
			input.value = input.value.substring(0, maxlength);
			alert('Votre texte ne doit pas dépasser '+maxlength+' caractères!');
		   }
		}
		</script>
		
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<div class="container-fluid">
			<div class="nav sticky-top navbar-light bg-light">
				<span class="navbar-brand mb-0 h1">Inscription</span>
			</div>
			<?php

			include '../connexion.php';
			$conn = connectDB("localhost","cinema","root","");

			if (isset($_REQUEST['username'], $_REQUEST['password'])){
				
			  $username=$_REQUEST['username'];
			  $password=$_REQUEST['password'];
			// vérification du nb de caractères

			  //requête SQL + mot de passe crypté
				$req ="INSERT into administrateur (username, password) VALUES ('$username','".hash('sha256', $password)."')";
			  // Exécuter la requête sur la base de données
				$res = writeDB($conn,$req);
				
				if($res){
				   echo "<div class='sucess'>
						 <h3>Vous vous êtes inscrit avec succès.</h3>
						 <p>Cliquez ici pour vous <a href='login.php'>connecter</a>.</p>
						</div>";
				}
			}else{
			?>
			<div class="d-flex justify-content-center align-items-center">
				<form class="box form-signin" action="" method="post">
				
					<label for="inputUsername" class="my-3">Nom d'utilisateur</label>
					<input type="text" class="box-input form-control" name="username" placeholder="Nom d'utilisateur" required onkeyup="MaxLengthText(this, 50);"/>
					
					<label for="inputPassword" class="my-3">Mot de passe</label>
					<input type="password" class="box-input form-control" name="password" placeholder="Mot de passe" required onkeyup="MaxLengthText(this, 100);"/>
					
					<input type="submit" name="submit" value="S'inscrire" class="box-button btn btn-primary m-3 float-right" />
					
					<p class="box-register my-3 p-1 text-nowrap"><a href="login.php">Déjà inscrit?</a></p>
				</form>
			</div>
			<?php } ?>
		</div>
	</body>
</html>