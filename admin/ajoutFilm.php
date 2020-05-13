<?php

 include '../connexion.php';

 // appel de la méthode de connexion contenue dans "connexion.php"
$bdd=connectDB("localhost","cinema","root",""); 
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["usernameAdmin"])){
    header("Location: login.php");
    exit(); 
  }
?>
<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
	
	<script type="text/javascript" src="../jquery-3.4.1.js"></script>
	<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
	<link  href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
  <script>
	$(document).ready(function(){
		$("#ajoutFilm").click(function(event) {	
			if($('input[name=libelle]').val()="" || $('input[name=duree]').val()="" || $('input[name=description]').val()="" || $('input[name=sortie]').val()=""){
				$('#alert').append("Veuillez remplir tout les champs");
				$('#alert').show();
				return;
			}
			$.ajax({
                url: 'gestionAdmin.php',
                type:'POST',
                data:
                {
                    myFunction:'ajout_film',
                    myParams:{
                        libelle:$('input[name=libelle]').val(),
						duree:$('input[name=duree]').val(),
						description:$('input[name=description]').val(),
						sortie:$('input[name=sortie]').val()
                    }
                },
				
                success: function()
                {
					window.location.replace("tableauAdmin.php");
                },
				error : function(resultat, statut, erreur){
					alert( "error détectée:" + erreur.responseText);
				}
			});
		
		});
		
		$("#retour").click(function(event) {	
			window.location.replace("tableauAdmin.php");
		});
	});
	</script>
	
	<input value="Retour" id="retour" class="box-button btn btn-primary">	
	<div class="container-sm"> 
		
		<label>Libelle du film</label>
		<input type='text' class="box-input form-control" name="libelle" placeholder="Libelle du film" required></input>
		
		<label>Date de sortie</label>
		<input type='date'  name="sortie" required pattern='[0-9]{4}-[0-9]{2}-[0-9]{2}'/><br/>
		
		<label>Durée du film</label>
		<input type='number' class="box-input form-control" name="duree" placeholder="Durée du film (en min)" required></input>
		
		<label>Description</label>
		<input type='text'  class="box-input form-control" name="description" placeholder="Description du film" required></input><br/>
		
		<input type="submit" value="Valider " name="submit" id="ajoutFilm" class="btn btn-primary">
		<div id="alert" class='alert alert-danger'></div>
	</div>
	
	
	
	
	</body>
</html>