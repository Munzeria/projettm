<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		
		<script type="text/javascript" src="jquery-3.4.1.js"/>
		<script type="text/javascript" src="bootstrap/js/bootstrap.js"/>
		
		<link  href="bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link href="admin/logincss.css" rel="stylesheet">
	</head>
	<body>
		<?php
		$conn = mysqli_connect('localhost', 'root', '', 'cinema');
		session_start();
		

		if (isset($_POST['username']) && isset($_POST['password']) ){
			$username=$_REQUEST['username'];
			$password=$_REQUEST['password'];
			

			$query = "SELECT * FROM userInformation WHERE username='$username' and password='".hash('sha256', $password)."'";
			$result = mysqli_query($conn,$query) or die(mysql_error());
			$rows = mysqli_num_rows($result);
			if($rows==1){
			  $_SESSION['username'] = $username;
			  header("Location: cinema.html");
			}
			else{
				$message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
			}	
		}
		?>
		<form class="box container-sm sm-1 form-signin" action="" method="post" name="login">
			
			<label for="inputUsername">Nom d'utilisateur</label>
			<input type="text" id="inputUsername" class="box-input form-control" name="username" placeholder="Nom d'utilisateur" required>
			
			<label for="inputPassword">Mot de passe</label>
			<input type="password" id="inputPassword" class="box-input form-control" name="password" placeholder="Mot de passe" required>
			
			<input type="submit" value="Connexion " name="submit" class="box-button btn btn-primary">
			
			<?php if (! empty($message)) { ?>
				<p class="errorMessage"><?php echo $message; ?></p>
				
			<?php } ?>
		</form>
	</body>
</html>