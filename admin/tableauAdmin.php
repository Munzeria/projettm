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
							str+="<div class='table-responsive' id='getTableProjection'><table class='table table-hover'><thead><tr><th scope='col'>Titre du film</th><th scope='col'>Date de la séance</th><th scope='col'>Genre de la séance</th><th scope='col'>Salle</th><th scope='col'>Supprimer</th></tr></thead><tbody>";
							for(var i in data){
								str+="<tr><th scope='row'>"+data[i].titre+"</th><td>"+data[i].horaire+"</td><td>"+data[i].genre+"</td><td>"+data[i].salle+"</td>";
								str+="<td><button type='submit' class='btn-supprimer-projection btn-info' data-horaire='" + data[i].horaire + "' data-salle='"+  data[i].salle +"' >Supprimer</button></td></tr>";
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
							str+="<div class='table-responsive-sm' id='getTableGenres'><table class='table table-hover'><thead><tr><th scope='col'>id genre</th><th scope='col'>Libelle</th><th scope='col'>Supprimer</th></tr></thead><tbody>";
							for(var i in data){
								str+="<tr><th scope='row'>"+data[i].idGenre+"</th><td>"+data[i].libelle+"</td>";
								str+="<td><button type='submit' class='btn-supprimer-genre btn-info' data-id='" + data[i].idGenre+"' >Supprimer</button></td></tr>";
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
							str+="<div class='table-responsive-sm' id='getTableFilms'><table class='table table-hover'><thead><tr><th scope='col'>Titre</th><th scope='col'>date de sortie</th><th scope='col'>durée</th><th scope='col'>Supprimer</th></tr></thead><tbody>";
							for(var i in data){
								str+="<tr><th scope='row'>"+data[i].titre+"</th><td>"+data[i].dateSortie+"</td><td>"+data[i].duree+"</td>";
								str+="<td><button type='submit' class='btn-supprimer-film btn-info' data-id='" + data[i].idFilm+"'>Supprimer</button></td></tr>";
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
							str+="<div class='table-responsive' id='getTableFilms'><table class='table table-hover'><thead><tr><th scope='col'>Id de la salle</th><th scope='col'>capacite</th><th scope='col'>Supprimer</th></tr></thead><tbody>";
							for(var i in data){
								str+="<tr><th scope='row'>"+data[i].idSalle+"</th><td>"+data[i].capacite+"</td>";
								str+="<td><button type='submit' class='btn-supprimer-salle btn-info' data-id='" + data[i].idSalle+"'>Supprimer</button></td></tr>";
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
				
			});
		</script>
		
		<div class="container-fluid"> 
			<div class="nav sticky-top navbar-light bg-light">
				<ul class="nav nav-tabs " id="myTab" role="tablist">
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
			</div>
	
			<div class="tab-content">
		
				<div class="tab-pane active" id="projection" role="tabpanel" aria-labelledby="home-tab">
					<button id="ajoutProjection" class="btn-info">Ajouter une projection</button>
					<div id="tableProjections"></div>
				</div>
				<div class="tab-pane " id="film" role="tabpanel" aria-labelledby="home-tab">
					<button id="ajoutFilm" class="btn-info">Ajouter un film</button>
					<div id="tableFilms"></div>
				</div>
				<div class="tab-pane " id="genre" role="tabpanel" aria-labelledby="home-tab">
					<button id="ajoutGenre" class="btn-info">Ajouter un genre de projection</button>
					<div id="tableGenres"></div>
				</div>
				<div class="tab-pane " id="salle" role="tabpanel" aria-labelledby="home-tab">
					<button id="ajoutSalle" class="btn-info">Ajouter une salle</button>
					<div id="tableSalles"></div>
				</div>
			</div>
		</div>
	</body>
</html>