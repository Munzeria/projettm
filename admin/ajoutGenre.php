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
				$('#alert').hide();
				
				$("#ajoutGenre").click(function(event) {
					$('#alert').empty();
					$('#alert').hide();
					if($('input[name=libelle]').val()=="" || $('input[name=prixAdulte').val()=="" || $('input[name=prixEnfant]').val()=="" || $('input[name=prixEtudiant]').val()=="" || $('input[name=prixSenior]').val()==""){
						$('#alert').append("Erreur ! Veuillez remplir tous les champs.");
						$('#alert').show();
						return;
					}
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
							window.location.replace("index.php");
						},
						error : function(resultat, statut, erreur){
							alert( "error détectée:" + erreur.responseText);
						}
					});
				});
				
				$("#retour").click(function(event) {	
				window.location.replace("index.php");
				});
			});
		</script>
		
		<nav class="navbar navbar-light bg-light">
			<span class="navbar-brand mb-0 h1">Ajout d'un genre de projection</span>
			<input value="Retour" id="retour" class="btn btn-sm btn-secondary">	
		</nav>
		
		<div class="container-xl mt-2"> 
		
			<div id="alert" class='alert alert-danger my-3'></div>
		
			<label class="my-1">Libelle du genre</label>
			<input type='text' class="box-input form-control" name="libelle" placeholder="Libelle du film" required></input>
			
			<label class="my-1">Prix adulte</label>
			<input type='number' class="box-input form-control" name="prixAdulte" placeholder="tarif adulte " required></input>
			
			<label class="my-1">Prix enfant</label>
			<input type='number' class="box-input form-control" name="prixEnfant" placeholder="tarif enfant " required></input>
			
			<label class="my-1">Prix senior</label>
			<input type='number' class="box-input form-control" name="prixSenior" placeholder="tarif senior " required></input>
			
			<label class="my-1">Prix étudiant</label>
			<input type='number' class="box-input form-control" name="prixEtudiant" placeholder="tarif étudiant " required></input>
			
			<input value="Valider" id="ajoutGenre" class="btn btn-primary float-right mt-4">
		</div>
	</body>
</html>