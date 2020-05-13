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
		<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<script type="text/javascript" src="../jquery-3.4.1.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
		
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<script>
			function getProjections(){
				var str="";
				$.ajax({
						url: 'gestionAdmin.php',
						type:'POST',
						data:
						{
							myFunction:'get_projections',
							myParams:{
								
							}
						},
						async:false,  
						dataType: "json",
						
						success: function(data)
						{
							str+="<div class='table' id='getTableProjection'><table class='table table-hover'><thead>"+
								"<tr class='row'><th scope='col-6' class='col'>Titre du film</th>"+
								"<th scope='col' class='col-2'>Date de la séance</th>"+
								"<th scope='col' class='col-2'>Genre de la séance</th>"+
								"<th scope='col' class='col-1'>Salle</th>"+
								"<th scope='col' class='col-1'>Supprimer</th></tr></thead><tbody>";
							for(var i in data){
								str+="<tr class='row'>"+
									"<th scope='col' class='col-6'>"+data[i].titre+"</th>"+
									"<td class='col-2'>"+data[i].horaire+"</td>"+
									"<td class='col-2'>"+data[i].genre+"</td>"+
									"<td class='col-1'>"+data[i].salle+"</td>";
								str+="<td class='col-1'><button type='submit' class='btn btn-sm btn-danger btn-supprimer-projection' data-horaire='" + data[i].horaire + "' data-salle='"+  data[i].salle +"' >Supprimer</button></td></tr>";
							}
							str+="</tbody></div>";
						},
						error : function(resultat, statut, erreur){
							alert( "Couldn't fetch 'Film' list: " + resultat.responseText);
						}
				});
				return str;
			};
	
			function getGenres(){
				var str="";
				$.ajax({
						url: 'gestionAdmin.php',
						type:'POST',
						data:
						{
							myFunction:'get_Genres',
							myParams:{
								
							}
						},
						async:false,  
						dataType: "json",
						
						success: function(data)
						{
							str+="<div class='table' id='getTableGenres'><table class='table table-hover'><thead><tr>"+
							"<th scope='col' class='col'>Libellé</th>"+
							"<th scope='col' class='col'>ID</th>"+
							"<th scope='col' class='col'>Supprimer</th>"+
							"</tr></thead><tbody>";
							for(var i in data){
								str+="<tr><th scope='row' class='col'>"+data[i].libelle+"</th>"+
								"<td class='col'>"+data[i].idGenre+"</td>";
								str+="<td class='col'><button type='submit' class='btn btn-sm btn-danger btn-supprimer-genre' data-id='" + data[i].idGenre+"' >Supprimer</button></td></tr>";
							}
							str+="</tbody></div>";
						},
						error : function(resultat, statut, erreur){
							alert( "error détectée:" + resultat.responseText);
						}
				});
				return str;
			};
	
			function getFilms(){
				var str="";
				$.ajax({
						url: 'gestionAdmin.php',
						type:'POST',
						data:
						{
							myFunction:'get_films',
							myParams:{
								
							}
						},
						async:false,  
						dataType: "json",
						
						success: function(data)
						{
							str+="<div class='table' id='getTableFilms'><table class='table table-hover'><thead><tr>"+
							"<th scope='col' class='col'>Titre</th>"+
							"<th scope='col' class='col text-nowrap'>Date de sortie</th>"+
							"<th scope='col' class='col'>Durée</th>"+
							"<th scope='col' class='col'>Supprimer</th></tr></thead><tbody>";
							for(var i in data){
								str+="<tr><th scope='row' class='col'>"+data[i].titre+"</th>"+
								"<td class='col'>"+data[i].dateSortie+"</td>"+
								"<td class='col'>"+data[i].duree+"</td>";
								str+="<td class='col'><button type='submit' class='btn btn-sm btn-danger btn-supprimer-film' data-id='" + data[i].idFilm+"'>Supprimer</button></td></tr>";
							}
							str+="</tbody></div>";
						},
						error : function(resultat, statut, erreur){
							alert( "error détectée:" + resultat.responseText);
						}
				});
				return str;
			};
			
			function getSalles(){
				var str="";
				$.ajax({
						url: 'gestionAdmin.php',
						type:'POST',
						data:
						{
							myFunction:'get_salles',
							myParams:{
								
							}
						},
						async:false,  
						dataType: "json",
						
						success: function(data)
						{
							str+="<div class='table' id='getTableFilms'><table class='table table-hover'><thead><tr>"+
							"<th scope='col' class='col'>Salle n°</th>"+
							"<th scope='col' class='col'>Capacité</th>"+
							"<th scope='col' class='col'>Supprimer</th></tr></thead><tbody>";
							for(var i in data){
								str+="<tr><th scope='row' class='col'>"+data[i].idSalle+"</th>"+
								"<td class='col'>"+data[i].capacite+"</td>";
								str+="<td class='col'><button type='submit' class='btn btn-sm btn-danger btn-supprimer-salle' data-id='" + data[i].idSalle+"'>Supprimer</button></td></tr>";
							}
							str+="</tbody></div>";
						},
						error : function(resultat, statut, erreur){
							alert( "error détectée:" + resultat.responseText);
						}
				});
				return str;
			};
	
/* ************************************************************** */ 

			$(document).ready(function(){
		
				$.ajax({
					url: 'gestionAdmin.php',
					type:'POST',
					data:
					{
						myFunction:'connexionUser',
						myParams:{
							
						}
					},
					async:false, 				
					success: function(){
						
					},
					error : function(resultat, statut, erreur){
							alert( "error détectée:" + resultat.responseText);
					}
				});
				
				var projections=getProjections();
				$("#tableProjections").html(projections);
				
				var genres=getGenres();
				$("#tableGenres").html(genres);
				
				var films=getFilms();
				$("#tableFilms").html(films);
				
				var salles=getSalles();
				$("#tableSalles").html(salles);
			
				/* SUPPRIMER UNE PROJECTION */ 
				$(".btn-supprimer-projection").click(function(event) {
					horaireProj=$(this).data("horaire");
					salle = $(this).data("salle");
					$(this).parents("tr").remove();
					
					$.ajax({
						url: 'gestionAdmin.php',
						type:'POST',
						data:
						{
							myFunction:'supprimer_projection',
							myParams:{
								horaire:horaireProj,
								salle:salle
							}
						},
						success: function(){
						
						},
						error : function(resultat, statut, erreur){
							alert( "error détectée:" + resultat.responseText);
						}
					})
				});
				
				/*  SUPPRIMER UN GENRE */ 
				$(".btn-supprimer-genre").click(function(event) {
					id=$(this).data("id");
					$(this).parents("tr").remove();
					
					$.ajax({
						url: 'gestionAdmin.php',
						type:'POST',
						data:
						{
							myFunction:'supprimer_genre',
							myParams:{
								idGenre:id
							}
						},
						success: function(){
							alert("ok");
						},
						
						error : function(resultat, statut, erreur){
							alert( "error détectée:" + resultat.responseText);
						}
					})
				});
				
				/*   SUPPRIMER UN FILM */ 
				$(".btn-supprimer-film").click(function(event) {
					id=$(this).data("id");
					$(this).parents("tr").remove();
					
					$.ajax({
						url: 'gestionAdmin.php',
						type:'POST',
						data:
						{
							myFunction:'supprimer_film',
							myParams:{
								idFilm:id
							}
						},
						success: function(){
							//alert
						},
						
						error : function(resultat, statut, erreur){
							alert( "error détectée:" + resultat.responseText);
						}
					})
				});
				
				/* Supprimer UNE SALLE */ 
				$(".btn-supprimer-salle").click(function(event) {
					id=$(this).data("id");
					$(this).parents("tr").remove();
					
					$.ajax({
						url: 'gestionAdmin.php',
						type:'POST',
						data:
						{
							myFunction:'supprimer_salle',
							myParams:{
								idSalle:id
							}
						},
						success: function(){
							//alert
						},
						
						error : function(resultat, statut, erreur){
							alert( "error détectée:" + resultat.responseText);
						}
					})
				});
				
				
				/* REDIRECTIONS POUR LES AJOUTS */ 
				$("#ajoutProjection").click(function(event) {
					window.location.replace("ajoutProjection.php");
				});
				
				$("#ajoutFilm").click(function(event) {
					window.location.replace("ajoutFilm.php");
				});
				
				$("#ajoutGenre").click(function(event) {
					window.location.replace("ajoutGenre.php");
				});
				
				$("#ajoutSalle").click(function(event) {
					window.location.replace("ajoutSalle.php");
				});
				
				/*	DISCONNECT	*/
				$("#disconnect").click(function(event){
					$.ajax({
						url: 'logout.php',
						success: function(){
							window.location.replace("index.php");
						}
					})
				});
				
			});
		</script>
		
		<div class="container-fluid">
		
			<div class="nav sticky-top navbar-light bg-light">
			
				<span class="navbar-brand mb-0 h1">Gestion administrateur</span>
				
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="home-tab" data-toggle="tab" href="#projection" role="tab" aria-controls="home" aria-selected="false">Projections</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="projection-tab" data-toggle="tab" href="#film" role="tab" aria-controls="projection" aria-selected="true">Films</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="genre-tab" data-toggle="tab" href="#genre" role="tab" aria-controls="genre" aria-selected="true">Genres</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="genre-tab" data-toggle="tab" href="#salle" role="tab" aria-controls="genre" aria-selected="true">Salles</a>
					</li>
				</ul>
				
				<input value="Déconnexion" id="disconnect" class="nav btn btn-sm btn-outline-danger ml-auto m-1">
				
			</div>
	
			<div class="tab-content">
		
				<div class="tab-pane active" id="projection" role="tabpanel" aria-labelledby="home-tab">
					<button id="ajoutProjection" class="btn btn-primary my-3 float-right">Ajouter une projection</button>
					<div id="tableProjections"></div>
				</div>
				<div class="tab-pane " id="film" role="tabpanel" aria-labelledby="home-tab">
					<button id="ajoutFilm" class="btn btn-primary my-3 float-right">Ajouter un film</button>
					<div id="tableFilms"></div>
				</div>
				<div class="tab-pane " id="genre" role="tabpanel" aria-labelledby="home-tab">
					<button id="ajoutGenre" class="btn btn-primary my-3 float-right">Ajouter un genre de projection</button>
					<div id="tableGenres"></div>
				</div>
				<div class="tab-pane " id="salle" role="tabpanel" aria-labelledby="home-tab">
					<button id="ajoutSalle" class="btn btn-primary my-3 float-right">Ajouter une salle</button>
					<div id="tableSalles"></div>
				</div>
			</div>
		</div>
	</body>
</html>