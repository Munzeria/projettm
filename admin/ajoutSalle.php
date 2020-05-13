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
				$('#alert').hide();
				$("#ajoutSalle").click(function(event) {	
					$.ajax({
						url: 'gestionAdmin.php',
						type:'POST',
						data:
						{
							myFunction:'ajout_salle',
							myParams:{
								capacite:$('input[name=capacite]').val(),
								numeroSalle:$('input[name=num]').val()
							}
						},
						async:false,				
						success: function(data)
						{	
							if(data==false) {
								$('#alert').append("Salle déja enregistrée");
								$('#alert').show();
							}
							else window.location.replace("index.php");
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
			<span class="navbar-brand mb-0 h1">Ajout d'une salle</span>
			<input value="Retour" id="retour" class="btn btn-sm btn-secondary">	
		</nav>	
		
		<div class="container-sm"> 
		
			<div id="alert" class='alert alert-danger'></div>
		
			<label class="my-1">Numéro de la salle</label>
			<input type='number' class="box-input form-control" name="num" placeholder="Numéro de la salle" required></input>
			
			<label class="my-1">Capacité de la nouvelle salle</label>
			<input type='number' class="box-input form-control" name="capacite" placeholder="Capacité de la salle" required></input>
			<input type="button" value="Valider" id="ajoutSalle" class="btn btn-primary float-right mt-4"/>
			
		</div>
	</body>
</html>