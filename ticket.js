var qte_ticket=[0,0,0,0];

function createTable(retour){
	var table="";
	table+="<div class='table-responsive-sm' id='getTable'><table class='table table-hover'><thead><tr><th scope='col'>Type de ticket</th><th scope='col'>Prix</th><th scope='col'>Quantité</th><th scope='col'>Prix total</th></tr></thead>";
	table+="<tr><th>Enfant</th><th >"+retour.tarifEnfant+"€</th><th ><input type='button' value='-' class='btn' onclick='decrementer(0,qte_ticket,"+retour.tarifEnfant+")'/>    <output id=quantite_0>"+qte_ticket[0]+"</output>    <input type='button' value='+' class='btn' onclick='incrementer(0,qte_ticket,"+retour.tarifEnfant+")'/></th><th class='ligne' id='total_0'>"+qte_ticket[0]*retour.tarifEnfant+"€</th></tr>";
	table+="<tr><th>Etudiant</th><th >"+retour.tarifEtudiant+"€</th><th ><input type='button' value='-' class='btn' onclick='decrementer(1,qte_ticket,"+retour.tarifEtudiant+")'/>    <output id=quantite_1>"+qte_ticket[1]+"</output>    <input type='button' value='+' class='btn' onclick='incrementer(1,qte_ticket,"+retour.tarifEtudiant+")'/></th><th class='ligne' id='total_1'>"+qte_ticket[1]*retour.tarifEtudiant+"€</th></tr>";
	table+="<tr><th>Adulte</th><th >"+retour.tarifAdulte+"€</th><th ><input type='button' value='-' class='btn' onclick='decrementer(2,qte_ticket,"+retour.tarifAdulte+")'/>    <output id=quantite_2>"+qte_ticket[2]+"</output>    <input type='button' value='+' class='btn' onclick='incrementer(2,qte_ticket,"+retour.tarifAdulte+")'/></th><th class='ligne' id='total_2'>"+qte_ticket[2]*retour.tarifAdulte+"€</th></tr>";
	table+="<tr><th>Senior</th><th >"+retour.tarifSenior+"€</th><th ><input type='button' value='-' class='btn' onclick='decrementer(3,qte_ticket,"+retour.tarifSenior+")'/>    <output id=quantite_3>"+qte_ticket[3]+"</output>    <input type='button' value='+' class='btn' onclick='incrementer(3,qte_ticket,"+retour.tarifSenior+")'/></th><th class='ligne' id='total_3'>"+qte_ticket[3]*retour.tarifSenior+"€</th></tr>";
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