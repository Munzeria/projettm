<!DOCTYPE html>
<html>
<head>
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
    $req ="INSERT into administrateur (username, password) VALUES ('$username','".hash('sha256', $password)."')";
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
<form class="box" action="" method="post">
  <h1 class="box-logo box-title">Welcome</h1>
    <h1 class="box-title">S'inscrire</h1>
	
	
	
	<input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" required onkeyup="MaxLengthText(this, 50);"/>
    <input type="password" class="box-input" name="password" placeholder="Mot de passe" required onkeyup="MaxLengthText(this, 100);"/>
	
	
    <input type="submit" name="submit" value="S'inscrire" class="box-button" />
    <p class="box-register">Déjà inscrit? <a href="login.php">Connectez-vous ici</a></p>
</form>
<?php } ?>
</body>
</html>