
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
					alert( "error détectée:" + resultat.responseText);
				}
			});
			
		}
		
		
		
			$(document).ready(function(){
				
				$("#submit").click(function(event) {
					if($('input[id=inputAmount]').val()==0) {
						alert("Veuillez rentrer une somme");
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
							addMoney();
							alert("argent ajouté"); 
						},
						
						error : function(resultat, statut, erreur){
							alert( "error détectée:" + resultat.responseText);
						}
					});
					window.location.replace("../index.php");
				});
				
				
			});
	</script>
		
	</head>
	
	<body>
		<div class="box container-sm sm-1 form-signin">
			
			<label for="inputAmount">Montant</label>
			<input type="number" id="inputAmount" class="box-input form-control" name="amount" placeholder="Montant" required>
			<input type="submit" value="Valider " id="submit" class="box-button btn btn-primary">
		</div>
	</body>
</html>