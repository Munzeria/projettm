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
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<script type="text/javascript" src="../jquery-3.4.1.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
		<link  href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
	  
		<script>
		$(document).ready(function(){
			$("#ajoutGenre").click(function(event) {	
				$.ajax({
					url: 'gestionAdmin.php',
					type:'POST',
					data:
					{
						myFunction:'ajout_genre',
						myParams:{
							libelle:$('input[name=libelle]').val(),
							adulte:$('input[name=prixAdulte]').val(),
							enfant:$('input[name=prixEnfant]').val(),
							senior:$('input[name=prixSenior]').val(),
							etudiant:$('input[name=prixEtudiant]').val()
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
			
			<label>Libelle du genre</label>
			<input type='text' class="box-input form-control" name="libelle" placeholder="Libelle du film" required></input>
			
			<label>Prix adulte</label>
			<input type='number' class="box-input form-control" name="prixAdulte" placeholder="tarif adulte " required></input>
			
			<label>Prix enfant</label>
			<input type='number' class="box-input form-control" name="prixEnfant" placeholder="tarif enfant " required></input>
			
			<label>Prix senior</label>
			<input type='number' class="box-input form-control" name="prixSenior" placeholder="tarif senior " required></input>
			
			<label>Prix étudiant</label>
			<input type='number' class="box-input form-control" name="prixEtudiant" placeholder="tarif étudiant " required></input>
			
			<input value="Valider " id="ajoutGenre" class="btn btn-primary">
		</div>
	</body>
</html>