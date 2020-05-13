<?php
		session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
		<script type="text/javascript" src="../jquery-3.4.1.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
		<link type="text/css" rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
		<link href="logincss.css" rel="stylesheet">
		
		<script>
		var user;
		function addMoney(){
			$.ajax({
				url: 'gestionUser',
				type:'POST',
				data:
				{
					myFunction:'addMoney',
					myParams:{	
						username:user,
						argent:$('input[id=inputAmount]').val()
					}
				}, 
				success: function(){
				},
				
				error : function(resultat, statut, erreur){
				}
			});
			
		}
		
		
		
			$(document).ready(function(){
				
				$('#alert').hide();
				
				$("#submit").click(function(event) {
					if($('input[id=inputAmount]').val()==0) {
						$('#alert').append("Veuillez renseigner une somme.");
						$('#alert').show();
						return;
					}
					$.ajax({
						url: 'gestionUser',
						type:'POST',
						data:
						{
							myFunction:'connexionUser',
							myParams:{	
							}
						},
						async:false, 
						success: function(str){
							user=$.trim(str);
							if(!user) window.location.replace("loginUser.php");
							addMoney();
							alert("Votre porte-monnaie a bien été approvisionné."); 
						},
						
						error : function(resultat, statut, erreur){
						}
					});
					window.location.replace("../index.php");
				});
				
				$("#retour").click(function(event) {	
					window.location.replace("../index.php");
				});
				
				
			});
			
	</script>
		
	</head>
	
	<body>
	
		<div class="container-sm">
	
			
			
			
		
			<div class="box sm-1 form-signin m-2 p-2">
				
				<nav class="navbar navbar-light bg-light">
					<span class="navbar-brand mb-0 h1">Approvisionner le porte-monnaie</span>
					<input value="Retour" id="retour" class="btn btn-sm btn-secondary">	
				</nav>
				
				<div id="alert" class='alert alert-danger'></div>
				
				<label class="" for="inputAmount">Montant</label>
				<input type="number" id="inputAmount" class="box-input form-control" name="amount" placeholder="Montant" required>
				<input type="submit" value="Valider " id="submit" class="box-button btn btn-success">
			</div>
		</div>
	</body>
</html>