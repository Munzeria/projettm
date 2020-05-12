<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
</script>
</head>
<body>
<?php

include '../connexion.php';
$conn = connectDB("localhost","cinema","root","");

if (isset($_REQUEST['username'], $_REQUEST['password'])){
	
  $username=$_REQUEST['username'];
  $password=$_REQUEST['password'];
// vérification du nb de caractères

  //requête SQL + mot de passe crypté
    $req ="INSERT into userInformation (username, password) VALUES ('$username','".hash('sha256', $password)."')";
  // Exécuter la requête sur la base de données
    $res = writeDB($conn,$req);
    
	if($res){
       echo "<div class='sucess'>
             <h3>Vous êtes inscrit avec succès.</h3>
             <p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
			</div>";
    }
}else{
?>
<form class="box container-sm sm-1 form-signin" action="" method="post" name="register">

	<label for="inputUsername" >Nom d'utilisateur</label>
	<input type="text" id="inputUsername" class="box-input form-control" name="username" placeholder="Nom d'utilisateur" required onkeyup="MaxLengthText(this,50);">
	<label for="inputPassword" >Mot de passe</label>
	<input type="password" id="inputPassword" class="box-input form-control" name="password" placeholder="Mot de passe" required onkeyup="MaxLengthText(this,100);">
	<label for="inputPrenom" >Prénom</label>
	<input type="text" id="inputPrenom" class="box-input form-control" name="username" placeholder="Prénom" required onkeyup="MaxLengthText(this,150);">
	<label for="inputNom" >Nom</label>
	<input type="text" id="inputNom" class="box-input form-control" name="username" placeholder="Nom" required onkeyup="MaxLengthText(this,150);">
	<label for="inputAdresse" >Rue et numéro</label>
	<input type="text" id="inputAdresse" class="box-input form-control" name="username" placeholder="Rue et numéro" required onkeyup="MaxLengthText(this,150);">
	<label for="inputVille" >Ville</label>
	<input type="text" id="inputVille" class="box-input form-control" name="username" placeholder="Ville" required onkeyup="MaxLengthText(this,100);">
	<label for="inputCP" >Code postal</label>
	<input type="text" id="inputCP" class="box-input form-control" name="username" placeholder="Code postal" required onkeyup="MaxLengthText(this,6);">
	<label for="inputTelephone" >Téléphone</label>
	<input type="text" id="inputTelephone" class="box-input form-control" name="username" placeholder="Téléphone" required onkeyup="MaxLengthText(this,50);">
	
	
    <input type="submit" value="Inscription" name="submit" class="box-button btn btn-primary">
    <p class="box-register">Déjà inscrit? <a href="login.php">Connectez-vous ici</a></p>
</form>
<?php } ?>
</body>
</html>