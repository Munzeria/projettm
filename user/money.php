
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
			(document).ready(function(){
				$(".submit").click(function(event) {
					var id=$(this).data("id");
					$.ajax({
						url: 'addMoney.php',
						type:'POST',
						data:"username="+id,
						success: function(){
							
						},
						
						error : function(resultat, statut, erreur){
							alert( "error détectée:" + resultat.responseText);
						}
					})
				});
			});
	</script>
		
	</head>
	
	<body>
		<form class="box container-sm sm-1 form-signin" action="" method="post" name="login">
			
			<label for="inputAmount">Montant</label>
			<input type="number" id="inputAmount" class="box-input form-control" name="amoun" placeholder="Montant" required>
			<input type="submit" value="Valider " name="submit" class="box-button btn btn-primary">
		</form>
	</body>
</html>