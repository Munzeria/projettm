


	
<?php
	include 'connexion.php';
	// appel de la méthode de connexion contenue dans "connexion.php"
	$bdd=connectDB("localhost","cinema","root","");
	
	// récupération des séances 
	
	$req="SELECT idFilm, group_concat(genre.libelle order by idSalle, horaire separator '>') as 'genre', group_concat(idGenre order by idSalle, horaire separator '>') as 'idGenre', film.titre, film.duree, film.description, group_concat(horaire order by idSalle, horaire separator '>') as 'horaire', group_concat(idSalle order by idSalle, horaire separator '>') as 'idSalle' FROM projection inner join genre using(idGenre) 
	inner join film using(idFilm) where horaire>=now() group by idFilm";
	
	readDB($bdd,$req);

?>



