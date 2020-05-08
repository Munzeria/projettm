

<?php

 include '../connexion.php';

 // appel de la méthode de connexion contenue dans "connexion.php"
$bdd=connectDB("localhost","cinema","root",""); 
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit(); 
  }
?>

<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<script type="text/javascript" src="../jquery-3.4.1.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<link  href="bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="logincss.css" rel="stylesheet">
  </head>
  <body>
  
  
<script>
var str="";
$(document).ready(function(){
		// créations des listes déroulantes des différents films, salles et genres
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
					str+="<label>Choix du film</label><br/><select name='films' id='film-select'>";
                    for(var i in data){
						str+="<option value='"+data[i].titre+"'>"+data[i].titre+"</option>";	
					}
					str+="</select>";
					$("#getFilms").html(str);
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
					str+="<label>Choix de la salle</label><br/><select name='salles' id='salles-select'>";
                    for(var i in data){
						str+="<option value='"+data[i].idSalle+"'>"+data[i].idSalle+"</option>";	
					}
					str+="</select>";
					$("#getSalles").html(str);
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
					str+="<label>Choix du genre de la séance</label><br/><select name='genres' id='genres-select'>";
                    for(var i in data){
						str+="<option value='"+data[i].libelle+"'>"+data[i].libelle+"</option>";	
					}
					str+="</select>";
					$("#getGenres").html(str);
                },
				error : function(resultat, statut, erreur){
					alert( "error détectée:" + resultat.responseText);
				}
        });
		
		
		$("#ajoutF").click(function(event) {	
			$.ajax({
                url: 'gestionAdmin.php',
                type:'POST',
                data:
                {
                    myFunction:'ajout_film',
                    myParams:{
                        libelle:$('input[name=libelle]').val(),
						duree:$('input[name=duree]').val(),
						description:$('input[name=description]').val(),
						sortie:$('input[name=sortie]').val()
                    }
                },
				
                success: function()
                {
					
					alert("ok");
					
                },
				error : function(resultat, statut, erreur){
					alert( "error détectée:" + erreur.responseText);
				}
			});
		
		});
});
</script>

    <div class="success">
    <!--<h1>Bienvenue <?php echo $_SESSION['username']; ?>!</h1>-->
	
	<div class="container-sm"> 
		<div class="nav sticky-top navbar-light bg-light">
			<ul class="nav nav-tabs " id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="home-tab" data-toggle="tab" href="#ajoutProjection" role="tab" aria-controls="home" aria-selected="false">Ajouter une projection</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="projection-tab" data-toggle="tab" href="#ajoutFilm" role="tab" aria-controls="projection" aria-selected="true">Ajouter un film</a>
				</li>
			</ul>
		</div>
		
		
		<div class="tab-content">
		
			<div class="tab-pane active" id="ajoutProjection" role="tabpanel" aria-labelledby="home-tab">
				
					<div id="getFilms"></div>
					<div id="getSalles"></div>
					<div id="getGenres"></div>
					
					<label>Date et heure de la séance</label><br/>
					<input type='date'  required pattern='[0-9]{4}-[0-9]{2}-[0-9]{2}'/>
					<input type='time'  required />
					
					<input  value="Valider " id="ajoutProj" name="submit" class="box-button btn btn-primary">
			</div>
			
			<div class="tab-pane" id="ajoutFilm" role="tabpanel" aria-labelledby="projection-tab">
				<form class="box container-sm sm-1" action="" method="post" name="ajoutFilm">
				
					<label>Libelle du film</label>
					<input type='text' class="box-input form-control" name="libelle" placeholder="Libelle du film" required></input>
					
					<label>Date de sortie</label>
					<input type='date'  name="sortie" required pattern='[0-9]{4}-[0-9]{2}-[0-9]{2}'/><br/>
					
					<label>Durée du film</label>
					<input type='number' class="box-input form-control" name="duree" placeholder="Durée du film (en sec)" required></input>
					
					<label>Description</label>
					<input type='text'  class="box-input form-control" name="description" placeholder="Description du film" required></input><br/>
					
					<input type="submit" value="Valider " name="submit"id="ajoutF" class="box-button btn btn-primary">
				</form>
			</div>
		</div>
    </div>
		
	
	
	<label></label>
	
	<br/>
    <a href="logout.php">Déconnexion</a>
    </div>
  </body>
</html>