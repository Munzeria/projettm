<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<script type="text/javascript" src="../jquery-3.4.1.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
		
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	</head>
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
	  header("Location: index.php");
	}
	else{
		$_GET['error']=true;
	}
}
?>
	<body>
		<div class="container-fluid">
			
			<div class="nav sticky-top navbar-light bg-light">
				<span class="navbar-brand mb-0 h1">Gestion administrateur</span>
			</div>
			
			<div class="d-flex justify-content-center align-items-center">
				<form class="box form-signin" action="" method="post" name="login">
				
					<?php
						if(isset($_GET['error']) && $_GET['error']=true){
							echo "<div id='alert' class='alert alert-danger'>Nom d'utilisateur ou mot de passe incorrect !</div>";
						}
					?>
					
					<label for="inputUsername" class="my-3">Nom d'utilisateur</label>
					<input type="text" id="inputUsername" class="box-input form-control" name="username" placeholder="Nom d'utilisateur" required>
					
					<label for="inputPassword" class="my-3">Mot de passe</label>
					<input type="password" id="inputPassword" class="box-input form-control" name="password" placeholder="Mot de passe" required>
					
					<input type="submit" value="Connexion " name="submit" class="box-button btn btn-primary m-3 float-right">
				
				<?php if (! empty($message)) { ?>
					<p class="errorMessage"><?php echo $message; ?></p>
					
				<?php } ?>
				</form>
			</div>
		</div>
	</body>
</html>