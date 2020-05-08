

<?php

 include 'connexion.php';

 // appel de la méthode de connexion contenue dans "connexion.php"
$bdd=connectDB("localhost","cinema","root",""); 
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit(); 
  }
  else if(isset($_POST["username"])){
	  
	$username=$_REQUEST['username'];
	$password=$_REQUEST['password'];
  }
?>

<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<script type="text/javascript" src="jquery-3.4.1.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<link  href="bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="logincss.css" rel="stylesheet">
  </head>
  <body>
    <div class="success">
    <!--<h1>Bienvenue <?php echo $_SESSION['username']; ?>!</h1>-->
	
	<div class="container-sm"> 
		<div class="nav sticky-top navbar-light bg-light">
			<ul class="nav nav-tabs " id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="home-tab" data-toggle="tab" href="#ajoutProjection" role="tab" aria-controls="home" aria-selected="false">Ajouter une projection</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="projection-tab" data-toggle="tab" href="#ajoutFilm" role="tab" aria-controls="projection" aria-selected="true">Ajouter un film</a>
				</li>
			</ul>
		</div>
		
			<!-- Tab panes -->
		<div class="tab-content">
		
			<div class="tab-pane active" id="ajoutProjection" role="tabpanel" aria-labelledby="home-tab">
				<form class="box container-sm sm-1 form-signin" action="" method="post" name="login">
					<?php
			
						$result=$bdd->prepare('select titre from film');
						$result->execute();
						
						$rowAll = $result->fetchAll(PDO::FETCH_ASSOC); // on récupère TOUTES les lignes (en une seule fois)
						
						echo "<label>Choix du film</label><br/>";
						echo "<select name='films' id='film-select'>";
						
						foreach ( $rowAll as $row ) {
							$titre=$row['titre'];
							
							echo "<option value='$titre'>".$titre."</option>";		
							
						}
						
						echo "</select><br/>";
						
						
						$result=$bdd->prepare('select idSalle from salle');
						$result->execute();
						$rowAll = $result->fetchAll(PDO::FETCH_ASSOC);
						
						echo "<label>Choix de la salle</label><br/>";
						echo "<select name='salles' id='film-select'>";
						
						foreach ( $rowAll as $row ) {
							$salle=$row['idSalle'];
							
							echo "<option value='$salle'>".$salle."</option>";		
							
						}
						
						echo "</select><br/>";
						
						
						$result=$bdd->prepare('select libelle from genre');
						$result->execute();
						$rowAll = $result->fetchAll(PDO::FETCH_ASSOC);
						
						echo "<label>Choix du genre de la séance</label><br/>";
						echo "<select name='genres' id='film-select'>";
						
						foreach ( $rowAll as $row ) {
							$genre=$row['libelle'];
							
							echo "<option value='$genre'>".$genre."</option>";		
							
						}
						
						echo "</select><br/>";
						
						
					?>
					
				<label>Date et heure de la séance</label><br/>
				<input type='date'  required pattern='[0-9]{4}-[0-9]{2}-[0-9]{2}'>
				<input type='time'  required >
				</form>
			</div>
			
			<div class="tab-pane" id="ajoutFilm" role="tabpanel" aria-labelledby="projection-tab">
				<form class="box container-sm sm-1" action="" method="post" name="ajoutFilm">
				
					<label>Libelle du film</label>
					<input type='text' class="box-input form-control" name="libelle" placeholder="Libelle du film" required></input>
					
					<label>Durée du film</label>
					<input type='number' class="box-input form-control" name="duree" placeholder="Durée du film (en sec)" required></input>
					
					<label>Description</label>
					<input type='text'  class="box-input form-control" name="description" placeholder="Description du film" required></input><br/>
					
					<input type="submit" value="Valider " name="submit" class="box-button btn btn-primary">
				</form>
			</div>
		</div>
    </div>
		
	
	
	<label></label>
	
	<br/>
    <a href="logout.php">Déconnexion</a>
    </div>
  </body>
</html>