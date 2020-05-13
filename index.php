<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"  name="viewport" content="width=device-width, initial-scale=1"/>
		
		<link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		
		<link type="text/css" rel="stylesheet" href="styleIndex.css">
		
		<script type="text/javascript" src="jquery-3.4.1.js"></script>
		
		<script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script>
		
		<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
		
		<script type="text/javascript" src="ticket.js"></script>
	</head>
	<body>
		<div class="container-sm"> 
		
			<div class="nav sticky-top navbar-light bg-light container-sm">
				
				<!--	Navbar left items	-->
					<!--	HIDDDEN ON SMALL DEVICES	-->
				<ul class="nav nav-tabs d-none d-sm-flex" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link " id="projection-tab" data-toggle="tab" href="#projection" role="tab" aria-controls="projection" aria-selected="true">Projections</a>
					</li>
				</ul>
					<!--	HIDDEN ON LARGE DEVICES	-->
				<ul class="nav nav-tabs d-flex d-sm-none" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="projection-tab" data-toggle="tab" href="#projection" role="tab" aria-controls="projection" aria-selected="true">Projections</a>
					</li>
				</ul>
				
				<!--	Navbar right items-->
				<ul class="nav navbar-nav ml-auto">
					<li class="nav-item">
						<?php
						if(!isset($_SESSION['username'])){
							print "<a class='nav-link' href='user/loginUser.php'>Connexion</a>";
						}
						else{
							//print "<div >Bienvenue, <a href=''>" . $_SESSION['username'] . "</a> - <a href='user/logout.php'>déconnexion</a></div>";
							print "<div class='dropdown-menu-right'>"
									. "<button class='btn btn-link dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>"
									. $_SESSION['username']
									. "</button>"
									."<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>"
										."<a class='dropdown-item' href='user/edit.php'>Profil</a>"
										."<a class='dropdown-item' href='user/ticketList.php'>Tickets</a>"
										."<a class='dropdown-item' href='user/logout.php'>Déconnexion</a>"
									."</div>"
								. "</div>";
						}
						?>
					</li>
				</ul>
			</div>
			
				<!-- Tab panes -->
			<div class="tab-content container-sm">
				<div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
					<h1>Cinema Helha</h1>
					
					<div class="alert alert-info" role="alert">
						<h4 class="alert-heading">Information</h4>
						<p>Chers visiteurs, suite à la récente crise du Coronavirus, nous vous informons que nous serons momentanément fermé.<br/> Nous espérons vous revoir bientôt dans nos salles</p>
						<hr>
						<p class="mb-0">Prenez soin de vous mais aussi des autres</p>	
					</div>
					
					<div class="map-responsive">
						<iframe id="maps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2540.4153434885457!2d3.9831469132176607!3d50.45198992604477!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c24f8c6d057a9b%3A0x3cd5fd540db90ee1!2sHaute%20%C3%89cole%20Louvain%20en%20Hainaut%20Mons!5e0!3m2!1sfr!2sbe!4v1589382137366!5m2!1sfr!2sbe" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
					</div>
				</div>
				
				<div class="tab-pane" id="projection" role="tabpanel" aria-labelledby="projection-tab">
					<div id="afficher"></div>
					<div id="reserver">
						<button id="retour" class="btn-info" onclick="reset()">Retour au choix de projection</button>
						<div id="table"></div>
						<button id="valider" class="btn-info">Valider</button>
					</div>
				</div>
			</div>
			
		</div>
	</body>
</html>