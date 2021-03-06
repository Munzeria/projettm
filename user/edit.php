<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
		
		<link type="text/css" rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
		<link href="logincss.css" rel="stylesheet">
		
		<script type="text/javascript" src="../jquery-3.4.1.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript">
	//fonction pour limiter le nombre de caractères entrés dans un input
			function MaxLengthText(input,maxlength){
			  if (input.value.length > maxlength) {
				input.value = input.value.substring(0, maxlength);
				alert('Votre texte ne doit pas dépasser '+maxlength+' caractères!');
			   }
			}
			var user="";
			$(document).ready(function(){
				// get the current user
				$.ajax({
					url: 'gestionUser.php',
					type:'POST',
					data:
					{
						myFunction:'connexionUser',
						myParams:{
							
						}
					},
					async:false, 				
					success: function(str)
					{
						if(!$.trim(str)) window.location.replace("loginUser.php");
						// display the informations of the current user
						$.ajax({
							url: 'gestionUser.php',
							type:'POST',
							data:
							{
								myFunction:'getUser',
								myParams:{
									username: $.trim(str)
								}
							},
							async:false, 	
							dataType: "json",
							success: function(retour)
							{
								$("#inputUsername").val(retour[0]['username']);
								$("#inputPassword").val(retour[0]['username']);
								$("#inputPrenom").val(retour[0]['prenom']);
								$("#inputNom").val(retour[0]['nom']);
								$("#inputAdresse").val(retour[0]['addresse']);
								$("#inputVille").val(retour[0]['ville']);
								$("#inputCP").val(retour[0]['cp']);
								$("#inputTelephone").val(retour[0]['tel']);
							},
							error : function(resultat, statut, erreur){
							}
						});
					},
					error : function(resultat, statut, erreur){
					}
				});
				
				// updates the user's informations
				$("#valider").click(function(event) {
					$.ajax({
							url: 'gestionUser.php',
							type:'POST',
							data:
							{
								myFunction:'updateUser',
								myParams:{
									username:$('input[id=inputUsername]').val(),
									mdp: $('input[id=inputPassword]').val(),
									nom:$('input[id=inputNom]').val(),
									prenom:$('input[id=inputPrenom]').val(),
									adresse:$('input[id=inputAdresse]').val(),
									ville:$('input[id=inputVille]').val(),
									cp:$('input[id=inputCP]').val(),
									tel:$('input[id=inputTelephone]').val()
								}
							},
							success: function()
							{
								alert("Modifications effectuées.");
								window.location.replace("../index.php");
							},
							error : function(resultat, statut, erreur){
							}
						});
				});
				
			});
		</script>
	</head>
	<body>
	
		<form class="box container-sm sm-1 form-signin" action="" method="post" name="register">

			<label for="inputUsername" class="my-2">Nom d'utilisateur</label>
			<input type="text" id="inputUsername" class="box-input form-control" name="username" placeholder="Nom d'utilisateur" disabled>
				
			<label for="inputPassword" class="my-2">Mot de passe</label>
			<input type="password" id="inputPassword" class="box-input form-control" name="password" placeholder="Mot de passe" required onkeyup="MaxLengthText(this,100);">
				
			<label for="inputPrenom" class="my-2">Prénom</label>
			<input type="text" id="inputPrenom" class="box-input form-control" name="prenom" placeholder="Prénom" required onkeyup="MaxLengthText(this,150);">
				
			<label for="inputNom" class="my-2">Nom</label>
			<input type="text" id="inputNom" class="box-input form-control" name="nom" placeholder="Nom" required onkeyup="MaxLengthText(this,150);">
				
			<label for="inputAdresse" class="my-2">Rue et numéro</label>
			<input type="text" id="inputAdresse" class="box-input form-control" name="adresse" placeholder="Rue et numéro" required onkeyup="MaxLengthText(this,150);">
				
			<label for="inputVille" class="my-2">Ville</label>
			<input type="text" id="inputVille" class="box-input form-control" name="ville" placeholder="Ville" required onkeyup="MaxLengthText(this,100);">
				
			<label for="inputCP" class="my-2">Code postal</label>
			<input type="text" id="inputCP" class="box-input form-control" name="codepostal" placeholder="Code postal" required onkeyup="MaxLengthText(this,6);">
				
			<label for="inputTelephone" class="my-2">Téléphone</label>
			<input type="tel" id="inputTelephone" class="box-input form-control" name="telephone" placeholder="Téléphone" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" required onkeyup="MaxLengthText(this,50);">
				
				
			<div class="container">
				<input type="button" value="Retour" name="retour" class="box-button btn btn-danger m-2" onclick="window.location.assign('..');">
				<input id="valider" type="button" value="Valider" name="submit" class="box-button btn btn-success m-2 float-right">
			</div>
		</form>
	</body>
</html>