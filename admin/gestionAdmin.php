
<?php 

include '../connexion.php';

$bdd=connectDB("localhost","cinema","root",""); 

session_start();
  if(!isset($_SESSION["usernameAdmin"])){
    header("Location: login.php");
    exit(); 
  }

if (isset($_REQUEST['myFunction']) && $_REQUEST['myFunction'] != '')
{
    $_REQUEST['myFunction']($_REQUEST);

}

function get_films()
{	
	$bdd=connectDB("localhost","cinema","root","");
	$req ="select * from film";
	readDB($bdd,$req);
}

function get_Salles(){
	$bdd=connectDB("localhost","cinema","root","");
	$req='SELECT * from salle';
	readDB($bdd,$req);
}

function get_Genres(){
		
	// appel de la méthode de connexion contenue dans "connexion.php"
	$bdd=connectDB("localhost","cinema","root","");
	$req='SELECT libelle, idGenre from genre';
	readDB($bdd,$req);
}



function ajout_film($data){
	
	$bdd=connectDB("localhost","cinema","root","");
	
	$libelle=$data['myParams']['libelle'];
	$duree=$data['myParams']['duree'];
	$description=addslashes($data['myParams']['description']);
	$dateSortie=$data['myParams']['sortie'];
	
	$req = "insert into film (titre,datesortie,duree, description) values ('$libelle','$dateSortie','$duree','$description')";
	$exec = writeDB($bdd,$req);
	
}

function ajout_seance($data){
	
	$horaire=$data['myParams']['horaire'];
	$heure=$data['myParams']['heure'];
	$idSalle=$data['myParams']['idSalle'];
	$idGenre=$data['myParams']['idGenre'];
	$idFilm=$data['myParams']['idFilm'];
	
	$bdd=connectDB("localhost","cinema","root","");
	$req="select count(*) as 'count' from projection inner join film using (idFilm) where projection.horaire between '$horaire . ' ' . $heure' and adddate('$horaire . ' ' . $heure', interval film.duree minute) and projection.idSalle = '$idSalle'";
	$result=traitementReadDB($bdd,$req);
	
	if($result['count']==0){
		$req="insert into projection(horaire,idFilm,idSalle,idGenre) values ('$horaire . ' ' . $heure','$idFilm','$idSalle','$idGenre')";
		$exec = writeDB($bdd,$req);
		echo true;
	}
	else echo false;
	
}

function ajout_genre($data){
	
	$libelle=$data['myParams']['libelle'];
	$adulte=$data['myParams']['adulte'];
	$enfant=$data['myParams']['enfant'];
	$senior=$data['myParams']['senior'];
	$etudiant=$data['myParams']['etudiant'];
	
	$bdd=connectDB("localhost","cinema","root","");
	
	$req="insert into genre(libelle,tarifAdulte,tarifEnfant,tarifSenior,tarifEtudiant) values ('$libelle','$adulte','$enfant','$senior','$etudiant')";
	writeDB($bdd,$req);
	
	
}

function ajout_salle($data){
	$salle=$data['myParams']['numeroSalle'];
	$capacite=$data['myParams']['capacite'];
	
	$bdd=connectDB("localhost","cinema","root","");
	
	
	$req="select count(*) as 'test' from salle where idSalle='$salle'";
	$result=traitementReadDB($bdd,$req);
	
	if($result['test']==0){
		$req="insert into salle(idSalle,capacite) values ('$salle','$capacite')";
		writeDB($bdd,$req);
		echo true;
	}
	else{
		echo false;
	}
	
}




function get_projections(){
	
	$bdd=connectDB("localhost","cinema","root","");
	$req="select film.titre as 'titre', projection.horaire as 'horaire' , genre.libelle as 'genre', projection.idSalle as 'salle' from projection
	inner join film using(idFilm) inner join genre using(idGenre) order by projection.horaire";
	readDB($bdd,$req);
}


function supprimer_projection($data){
	$horaire=$data['myParams']['horaire'];
	$idSalle=$data['myParams']['salle'];
	
	$bdd=connectDB("localhost","cinema","root","");
	$req="delete from projection where horaire='$horaire' and idSalle='$idSalle'";
	writeDB($bdd,$req);
}

function supprimer_genre($data){
	$idGenre=$data['myParams']['idGenre'];
	$bdd=connectDB("localhost","cinema","root","");
	$req="delete from genre where idGenre='$idGenre'";
	writeDB($bdd,$req);
}

function supprimer_film($data){
	$idGFilm=$data['myParams']['idFilm'];
	$bdd=connectDB("localhost","cinema","root","");
	$req="delete from film where idFilm='$idGFilm'";
	writeDB($bdd,$req);
}

function supprimer_salle($data){
	$idSalle=$idGFilm=$data['myParams']['idSalle'];
	$bdd=connectDB("localhost","cinema","root","");
	$req="delete from salle where idSalle='$idSalle'";
	writeDB($bdd,$req);

}

?>