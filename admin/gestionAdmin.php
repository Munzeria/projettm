
<?php 

include '../connexion.php';

if (isset($_REQUEST['myFunction']) && $_REQUEST['myFunction'] != '')
{
    $_REQUEST['myFunction']($_REQUEST);

}


function get_films()
{	
	// appel de la méthode de connexion contenue dans "connexion.php"
	$bdd=connectDB("localhost","cinema","root","");
	$req ="select titre from film";
	readDB($bdd,$req);
}

function get_Salles(){
	// appel de la méthode de connexion contenue dans "connexion.php"
	$bdd=connectDB("localhost","cinema","root","");
	$req='SELECT idSalle from salle';
	readDB($bdd,$req);
}

function get_Genres(){
		
	// appel de la méthode de connexion contenue dans "connexion.php"
	$bdd=connectDB("localhost","cinema","root","");
	$req='SELECT libelle from genre';
	readDB($bdd,$req);
}


function ajout_film($data){
	
	$bdd=connectDB("localhost","cinema","root","");
	
	$libelle=$data['myParams']['libelle'];
	$duree=$data['myParams']['duree'];
	$description=$data['myParams']['description'];
	$dateSortie=$data['myParams']['sortie'];
	
	$req = "insert into film (titre,datesortie,duree, description) values ('$libelle','$dateSortie','$duree','$description')";
	$exec = writeDB($bdd,$req);
	// vérifier si la requête d'insertion a réussi
	if($exec){
		echo 'Données insérées';
	}else{
		echo "Échec de l'opération d'insertion";
	}
	
	
}


?>