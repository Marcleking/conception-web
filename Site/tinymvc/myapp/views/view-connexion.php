<!DOCTYPE html>
<html>
	<head>
		<title>Le coureur nordique</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="<?=url?>/../css/foundation.css" />

		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

		<script src="<?=url?>/../js/jquery.js"></script>
		<script src="<?=url?>/../js/jquery-ui-1.10.3.custom.min.js"></script>

	</head>
	<body>
		<div class="row">
			<?=$entete?>
		</div>
		<div class="row">
			<div class="medium-5 medium-centered columns">
				<!-- Formulaire de connexion -->
				<form data-abide action="<?=url?>/connexion" method="POST">
					<div class="panel">
						<h1>Connexion</h1>

						<div>
						  	<label for="user">Nom d'utilisateur</label>
					      	<input type="text" id="user" name="user" placeholder="Entrez votre nom d'utilisateur..." required />
					      	<small class="error">Veuillez indiquez un nom d'utilisateur.</small>
				      	</div>

				      	<div>
					      	<label>Mot de passe</label>
					      	<input type="password" class="password" id="pwd" name="pwd" placeholder="Entrez votre mot de passe..." required pattern="alpha" />
					      	<small class="error">Veuillez indiquez un mot de passe.</small>
				      	</div>
				      	
				      	<input type="submit" class="button"/>
			      	</div>
			  	</form>
			</div>
	  	</div>
	  	
		<script src="<?=url?>/../js/foundation.min.js"></script>
		<script src="<?=url?>/../js/foundation/foundation.abide.js"></script>
	  	<script>
		 	$(document).foundation();
		</script>
	</body>
</html>