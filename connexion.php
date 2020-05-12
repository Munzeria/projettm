

<?php

function connectDB($host, $bdname, $user, $pass){
	
	try {
		$bdd = new PDO('mysql:host=' . $host .';dbname=' . $bdname . ';charset=utf8', $user, $pass);
	} 
	catch(Exception $e){
				die('Erreur : '.$e->getMessage());
	}

	return $bdd;
}

function readDB($bdd,$req){
	
	$result=$bdd->prepare($req);
	$result->execute();

	$rs = $result->fetchAll(PDO::FETCH_ASSOC);
	$result->closeCursor();
	echo json_encode($rs);
}

function writeDB($bdd,$request){
	
	$result=$bdd->prepare($request);
	$result->execute();
	return $result;
}

function traitementReadDB($bdd,$req){
	$result=$bdd->prepare($req);
	$result->execute();

	$rs = $result->fetch(PDO::FETCH_ASSOC);
	
	return $rs;
}
?>