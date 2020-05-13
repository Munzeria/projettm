

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0"/>
	
	<script type="text/javascript" src="../jquery-3.4.1.js"></script>
	<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
	<link  href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="logincss.css" rel="stylesheet">
</head>
<body>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'cinema');
session_start();

if (isset($_POST['username']) && isset($_POST['password']) ){
    $username=$_REQUEST['username'];
	$password=$_REQUEST['password'];
	
    $query = "SELECT * FROM administrateur WHERE username='$username' and password='".hash('sha256', $password)."'";
	$result = mysqli_query($conn,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
  
	if($rows==1){
	  $_SESSION['usernameAdmin'] = $username;
	  header("Location: tableauAdmin.php");
	}
	
}
?>
<form class="box container-sm sm-1 form-signin" action="" method="post" name="login">
	
	<label for="inputUsername" >Nom d'utilisateur</label>
	<input type="text" id="inputUsername" class="box-input form-control" name="username" placeholder="Nom d'utilisateur" required>
	
	<label for="inputPassword">Mot de passe</label>
	<input type="password" id="inputPassword" class="box-input form-control" name="password" placeholder="Mot de passe" required>
	
	<input type="submit" value="Connexion " name="submit" class="box-button btn btn-primary">
	
	<p class="box-register">Vous êtes nouveau ici? <a href="register.php">S'inscrire</a></p>
	
	<?php if (! empty($message)) { ?>
		<p class="errorMessage"><?php echo $message; ?></p>
		
	<?php } ?>
</form>
</body>
</html>