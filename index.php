<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"  name="viewport" content="width=device-width, initial-scale=1"/>
		
		<link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		
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
						<a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" id="projection-tab" data-toggle="tab" href="#projection" role="tab" aria-controls="projection" aria-selected="true">Projections</a>
					</li>
				</ul>
					<!--	HIDDEN ON LARGE DEVICES	-->
				<ul class="nav nav-tabs d-flex d-sm-none" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" id="projection-tab" data-toggle="tab" href="#projection" role="tab" aria-controls="projection" aria-selected="true">Projections</a>
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
				<div class="tab-pane" id="home" role="tabpanel" aria-labelledby="home-tab">
				
				</div>
				
				<div class="tab-pane active" id="projection" role="tabpanel" aria-labelledby="projection-tab">
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