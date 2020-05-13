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
		<meta charset="utf-8" name="viewport" content="initial-scale=1"/>
		
		<script type="text/javascript" src="../jquery-3.4.1.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
		
		<link  href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<script>
			var str="";
			var selectedFilmProjection;
			var selectedSalleProjection;
			var selectedGenreProjection;
			$(document).ready(function(){
			
				$('#alert').hide();
				
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
							str+="<label class='my-1'>Choix du film</label><br/><select name='films' class='film' id='film-select'>";
							for(var i in data){
								str+="<option value='"+data[i].idFilm+"'>"+data[i].titre+"</option>";	
							}
							str+="</select>";
							$("#getFilms").html(str);
							selectedFilmProjection = $("select.film").children("option:selected").val();
							
							$("select.film").change(function(){
								selectedFilmProjection = $(this).children("option:selected").val();
							});
						},
						error : function(resultat, statut, erreur){
							alert( "error détectée:" + resultat.responseText);
						}
				});
				str="";
				$.ajax({
						url: 'gestionAdmin.php',
						type:'POST',
						data:
						{
							myFunction:'get_Salles',
							myParams:{
								
							}
						},
						async:false,  
						dataType: "json",
						
						success: function(data)
						{
							str+="<label class='my-1'>Choix de la salle</label><br/><select name='salles' class='salle' id='salles-select'>";
							for(var i in data){
								str+="<option value='"+data[i].idSalle+"'>"+data[i].idSalle+"</option>";	
							}
							str+="</select>";
							$("#getSalles").html(str);
							selectedSalleProjection = $("select.salle").children("option:selected").val();
							
							$("select.salle").change(function(){
								selectedSalleProjection = $(this).children("option:selected").val();
							});
							
						},
						error : function(resultat, statut, erreur){
							alert( "error détectée:" + resultat.responseText);
						}
				});
				str="";
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
							str+="<label class='my-1'>Choix du genre de la séance</label><br/><select name='genres' class='genre' id='genres-select'>";
							for(var i in data){
								str+="<option value='"+data[i].idGenre+"'>"+data[i].libelle+"</option>";	
							}
							str+="</select>";
							$("#getGenres").html(str);
							
							selectedGenreProjection = $("select.genre").children("option:selected").val();
							
							$("select.genre").change(function(){
								selectedGenreProjection = $(this).children("option:selected").val();
							});
						},
						error : function(resultat, statut, erreur){
							alert( "error détectée:" + resultat.responseText);
						}
				});
				
				$("#ajoutProj").click(function(event) {	
				
					$('#alert').empty();
					if($('input[name=horaire]').val()==""){
						$('#alert').append("Erreur ! Veuillez choisir une date.");
						$('#alert').show();
						return;
					}
					else if($('input[name=heure]').val()==""){
						$('#alert').append("Erreur ! Veuillez choisir une heure.");
						$('#alert').show();
						return;
					}

					$.ajax({
						url: 'gestionAdmin.php',
						type:'POST',
						data:
						{
							myFunction:'ajout_seance',
							myParams:{
								idFilm:selectedFilmProjection,
								horaire:$('input[name=horaire]').val(),
								idSalle:selectedSalleProjection,
								heure:$('input[name=heure]').val(),
								idGenre:selectedGenreProjection
							}
						},
						async:false,
						success: function(data)
						{
							if(data==false){
								$('#alert').append("La programmation n'a pas eu lieu. Cette salle occupée à la période choisie.");
								$('#alert').show();
							}
							else {
								alert("Le film " + selectedFilmProjection + " sera projetté en salle " + selectedSalleProjection + " le " + $('input[name=horaire]').val() + " à " + $('input[name=heure]').val() + ".");
								window.location.replace("tableauAdmin.php");
							}
						},
						error : function(resultat, statut, erreur){
							alert( "Erreur d'ajout de la projection:" + resultat.responseText);
						}
					});
				});
				
				$("#retour").click(function(event) {	
					window.location.replace("tableauAdmin.php");
				});
			});
		</script>
		
		<nav class="navbar navbar-light bg-light">
			<span class="navbar-brand mb-0 h1">Ajout d'une projection</span>
			<input value="Retour" id="retour" class="btn btn-sm btn-secondary">	
		</nav>
		
		<div class="container-xl mt-2"> 
		
			<div id="alert" class='alert alert-danger'></div>
		
			<div id="getFilms"></div>
			<div id="getSalles"></div>
			<div id="getGenres"></div>
			
			<label class="my-1">Date et heure de la séance</label><br/>
			<input type='date'  name="horaire" required pattern='[0-9]{4}-[0-9]{2}-[0-9]{2}'/>
			<input type='time'  name="heure" required />
			
			<input type="button" value="Valider" id="ajoutProj" class="btn btn-primary float-right mt-4">

		</div>
	</body>
</html>