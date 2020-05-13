<?php
		session_start();
?>
<!DOCTYPE html>
<html>
	<head>
	
		<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
		
		<script type="text/javascript" src="../jquery-3.4.1.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript">
			var user;
			function getTickets(){
				var str="";
				$.ajax({
						url: 'gestionUser.php',
						type:'POST',
						data:
						{
							myFunction:'getTicketsUser',
							myParams:{
								username:user
							}
						},
						async:false,  
						dataType: "json",
						
						success: function(data)
						{
							str+="<div class='table table-striped table-sm' id='getTableTickets'><table class='table table-hover'><thead><tr>"+
							"<th scope='col' class='col col-3'>Film</th>"+
							"<th scope='col' class='col col-2'>Horaire</th>"+
							"<th scope='col' class='col'>Salle</th>"+
							"<th scope='col' class='col'>Type</th>"+
							"<th scope='col' class='col'>Tarif</th>"+
							"<th scope='col' class='col'>Ticket</th></tr></thead><tbody>";
							for(var i in data){
								str+="<tr><th scope='row' class='col col-3 text-nowrap'>"+data[i].film+"</td>"+
								"<td class='col col-2'>"+data[i].horaire+"</th>"+
								"<td class='col'>"+data[i].salle+"</td>"+
								"<td class='col'>"+data[i].genre+"</td>"+
								"<td class='col'>"+data[i].tarif+"</td>";
								str+="<td class='col'>"+
								"<button type='submit' class='btn btn-editer btn-sm btn-success' data-id='" + data[i].id+"'>"+
								"<img src='../img/download.svg'/ width='18' heigth='18' class=''>"+
								"</button></td></tr>";
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
						if(!user) window.location.replace("loginUser.php");
						var retour=getTickets();
						$("#table").html(retour);
					},
					error : function(resultat, statut, erreur){
								alert( "error détectée:" + resultat.responseText);
					}
				});
				
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
				
				$("#return").click(function(event){
					window.location.replace("../index.php");
				});
			});	
		</script>
	</head>
	
	<body>
	
		<div class="nav sticky-top navbar-light bg-light">
			
				<img src="../img/ticket.png" class="p-1" width="50" height="50">
				<span class="navbar-brand mb-0 h1 m-1">Vos tickets</span>
				
				<input value="Retour" id="return" class="nav btn btn-sm btn-outline-primary ml-auto m-1">
				
			</div>
	
		<div id='table'></div>
	
	</body>
</html>