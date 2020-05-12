var qte_ticket=[0,0,0,0];

function createTable(retour){
	var table="";
	//	Titres des colonnes
	table+="<div class='table-responsive-sm' id='getTable'>"+
		"<table class='table table-hover'>"+
		"<thead><tr class='d-flex'>"+
		"<th class='col-4' scope='col'>Type de ticket</th>"+
		"<th class='col-2' scope='col'>Prix</th>"+
		"<th class='col-4' scope='col'>Quantité</th>"+
		"<th class='col-2' scope='col'>Prix total</th>"+
		"</tr></thead>";
	//	ENFANT
	table+="<tr class='d-flex'>"+
		"<td class='col-4'>Enfant</td>"+
		"<td class='col-2'>"+retour.tarifEnfant+"€</td>"+
		"<td class='col-4'><input type='button' value='-' class='btn btn-sm' onclick='decrementer(0,qte_ticket,"+retour.tarifEnfant+")'/>    <output id=quantite_0>"+qte_ticket[0]+"</output><input type='button' value='+' class='btn btn-sm' onclick='incrementer(0,qte_ticket,"+retour.tarifEnfant+")'/></td>"+
		"<td class='ligne col-2' id='total_0'>"+qte_ticket[0]*retour.tarifEnfant+"€</td>"+
		"</tr>";
	//	ETUDIANT
	table+="<tr class='d-flex'>"+
		"<td class='col-4'>Etudiant</td>"+
		"<td class='col-2'>"+retour.tarifEtudiant+"€</td>"+
		"<td class='col-4'><input type='button' value='-' class='btn btn-sm' onclick='decrementer(1,qte_ticket,"+retour.tarifEtudiant+")'/>    <output id=quantite_1>"+qte_ticket[1]+"</output>    <input type='button' value='+' class='btn btn-sm' onclick='incrementer(1,qte_ticket,"+retour.tarifEtudiant+")'/></td>"+
		"<td class='ligne col-2' id='total_1'>"+qte_ticket[1]*retour.tarifEtudiant+"€</td>"+
		"</tr>";
	//	ADULTE
	table+="<tr class='d-flex'>"+
		"<td class='col-4'>Adulte</td>"+
		"<td class='col-2'>"+retour.tarifAdulte+"€</td>"+
		"<td class='col-4'><input type='button' value='-' class='btn btn-sm' onclick='decrementer(2,qte_ticket,"+retour.tarifAdulte+")'/>    <output id=quantite_2>"+qte_ticket[2]+"</output>    <input type='button' value='+' class='btn btn-sm' onclick='incrementer(2,qte_ticket,"+retour.tarifAdulte+")'/></td>"+
		"<td class='ligne col-2' id='total_2'>"+qte_ticket[2]*retour.tarifAdulte+"€</td>"+
		"</tr>";
	//	SENIOR
	table+="<tr class='d-flex'>"+
		"<td class='col-4'>Senior</td>"+
		"<td class='col-2'>"+retour.tarifSenior+"€</td>"+
		"<td class='col-4'><input type='button' value='-' class='btn btn-sm' onclick='decrementer(3,qte_ticket,"+retour.tarifSenior+")'/>    <output id=quantite_3>"+qte_ticket[3]+"</output>    <input type='button' value='+' class='btn btn-sm' onclick='incrementer(3,qte_ticket,"+retour.tarifSenior+")'/></td>"+
		"<td class='ligne col-2' id='total_3'>"+qte_ticket[3]*retour.tarifSenior+"€</td>"+
		"</tr>";
	table+="</table></div>";
	return table;
}

function decrementer(id, table, prix){
	if(table[id]<=0) return;
	table[id]--;
	actualiser(id, table, prix);
}

function incrementer(id, table, prix){
	table[id]++;
	actualiser(id, table, prix);
}

function actualiser(id, table, prix){
	document.getElementById("quantite_"+id).innerHTML=table[id];
	document.getElementById("total_"+id).innerHTML=table[id]*prix+"€";
}

function reset(){
	qte_ticket=[0,0,0,0];
}

function getTicketAmount(){
	var amount=0;
	for(i in qte_ticket){
		amount+=qte_ticket[i];
	}
	return amount;
}

function getProjection()
		{	var str="";
			var horaireSplit;
			var genreSplit;
			var idGenreSplit;
			$.ajax(
			{
			  method: "GET",
			  url: "affichage.php",
			  async:false,  
			  dataType: "json"
			})
				
				// afficher aussi le type de séance 
				.done(function(data) {
					str+="<div id='accordion'>";
					
					for(var i in data){
						
						str+="<div class='card'> <div class='card-header' id='heading"+i+"'> <h5 class='mb-0'> <button class='btn btn-link' data-toggle='collapse' data-target='#collapse"+i+"' aria-expanded='false' aria-controls='collapse"+i+"'>"+data[i].titre+"</button></h5></div>";
						str+="<div id='collapse"+i+"' class='collapse' aria-labelledby='heading"+i+"' data-parent='#accordion'>";
						
						str+="<div class='card-body'>"+data[i].description+"<br>";
						
						// propose un bouton pour chaque représentation du même film
						horaireSplit=data[i].horaire.split(">");
						idGenreSplit=data[i].idGenre.split(">");
						genreSplit=data[i].genre.split(">");
						idSalleSplit=data[i].idSalle.split(">");
						
						// data-titre permet de stocker le nom du film auquel appartient le bouton pour le récupérer plus tard etc 
						for(var j in horaireSplit){
							str+="<br>"+genreSplit[j]+"<br>";
							str+="<button type='submit' class='btn-validation btn-info'  data-titre='" + data[i].titre + "' data-horaire='" + horaireSplit[j] + "' data-genre='" + idGenreSplit[j] + "' data-salle='"+ idSalleSplit[j] +"' >"+horaireSplit[j]+"</button><br>";
							
						}
						
						str+="</div></div></div>";
						
					}
					str+="</div>";
				})
				.fail(function(error) {
					alert( "error détectée:" + error.responseText);
					str="error détectée:" + error.responseText;
				})
				.always(function() {
					<!-- alert( "finished"  ); -->
				});
				
			  return str; 
		};
		
		$(document).ready(function(){
		
			
			$("#reserver").hide();
			
			filmList=getProjection();		
			$("#afficher").html(filmList);
			
			var chaine;
			var horaire;
			var genre;
			var salle;
			
			
			// fonction pour récup le film sélectionné
			$(".btn-validation").click(function(event) {
				// à afficher dans le résumé
				chaine=$(this).data("titre");
				horaire=$(this).data("horaire");
				genre = $(this).data("genre");
				salle = $(this).data("salle");
				
				
				$.ajax(
				{	
					//envoi d'une demande de récupération des prix des tickets selon le genre de la projection choisie
					method: "GET",
					url: "reservation.php",
					data: "genre="+genre,  
					dataType: "json",
					success : function(retour, statut){
						
						// création de la table avec les différents tickets
						$("#table").append(createTable(retour[0]));
						
						//afficher la div de la table / cacher celle des projections
						$("#reserver").show();
						$("#afficher").hide();
					},
					
					error : function(resultat, statut, erreur){
						alert( "error détectée:" + erreur.responseText);
					}
				})
			});
			
			$("#valider").click(function(event) {	
			
				$.ajax(
				{	
					method: "GET",
					url: "nombreTicket.php",
					data: "horaire="+horaire+"&salle="+salle,  
					dataType: "json",
					success : function(retour, statut){
						if(getTicketAmount()==0){
							alert("Commande impossible, il est impossible de commander 0 ticket !");
							return;
						}
						
						if(retour[0].nbTicketAvailable>=getTicketAmount()){
							//Valider commande
						}else{
							alert("Commande impossible, il ne reste que "+retour[0].nbTicketAvailable+" disponible.");
						}
					},
					
					error : function(resultat, statut, erreur){
						alert( "error détectée:" + erreur.responseText);
					}
				})
			});
			
			$("#retour").click(function(event) {
				$("#reserver").hide();
				$("#table").children("#getTable").remove();
				$("#afficher").show();
			});
});