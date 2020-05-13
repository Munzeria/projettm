
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
	<script type="text/javascript">
		var user;
		function getTickets(){
			var str="";
			$.ajax({
					url: 'gestionUser.php',
					type:'POST',
					data:
					{
						myFunction:'getTicketUser',
						myParams:{
							username:user
						}
					},
					async:false,  
					dataType: "json",
					
					success: function(data)
					{
						str+="<div class='table-responsive-sm' id='getTableTickets'><table class='table table-hover'><thead><tr><th scope='col'>Horaire</th><th scope='col'>Film</th><th scope='col'>salle</th><th scope='col'>Genre</th><th scope='col'>Tarif</th><th scope='col'>Download ticket</th></tr></thead><tbody>";
						for(var i in data){
							str+="<tr><th scope='row'>"+data[i].horaire+"</th><td>"+data[i].film+"</td><td>"+data[i].salle+"</td><td>"+data[i].genre+"</td><td>"+data[i].tarif+"</td>";
							str+="<td><button type='submit' class='btn-editer btn-info' data-id='" + data[i].id+"'>Download PDF</button></td></tr>";
						}
						str+="</tbody></div>";
					},
					error : function(resultat, statut, erreur){
						alert( "error détectée:" + resultat.responseText);
					}
			});
			return str;
		};
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
					user= $.trim(str);
					
					var retour=getTickets();
					$("#table").html(retour);
				},
				error : function(resultat, statut, erreur){
							alert( "error détectée:" + resultat.responseText);
				}
			});
			// à régler
			$(".btn-editer").click(function(event) {
				var id=$(this).data("id");
				$.ajax({
					url: 'jsonTicket.php',
					type:'POST',
					data:"idTicket="+id,
					success: function(retour){
						window.open("generateTicket.php?json="+retour);
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
		<div id='table'></div>
	
	</body>
	
	
</html>