﻿
	  <li <?=$accueil?> id="numero1"><a href="."><i class="fa fa-home fa-2x"></i> Accueil (<?php echo $_SESSION['user']->getType(); ?>)</a></li>
	  <hr />
	  <li <?=$message?> id="numero2"><a href="<?=url?>/message"><i class="fa fa-envelope fa-2x"></i> Message</a></li>
	  <hr />
	  <?php if ( $_SESSION['user']->getType() == "Gestionnaire") { ?>
	  	<li <?=$envoyerMessage?> id="numero9"><a href="<?=url?>/envoyerMessage"><i class="fa fa-envelope fa-2x"></i> Envoyer un message</a></li>
	  	<hr />
	  <?php } ?>
	  <li <?=$documents?> id="numero3"><a href="<?=url?>/documents"><i class="fa fa-folder fa-2x"></i> Documents</a></li>
	  <hr />
	  <li <?=$horaire?> id="numero4"><a href="<?=url?>/horaire"><i class="fa fa-calendar fa-2x"></i> Affichage d’un horaire</a></li>
	  <hr />
	  <li <?=$dispo?> id="numero5"><a href="<?=url?>/disponibilites"><i class="fa fa-clock-o fa-2x"></i> Saisie des disponibilités</a></li>
	  <hr />
	  <li <?=$gestionCompte?> id="numero6"><a href="<?=url?>/gestionCompte"><i class="fa fa-cogs fa-2x"></i> Gestion du compte</a></li>
	  <hr />
	  <?php if ( $_SESSION['user']->getType() == "Gestionnaire") { ?>
	  	<li <?=$gestionComptes?> id="numero7"><a href="<?=url?>/gestionComptes"><i class="fa fa-users fa-2x"></i> Gestion des comptes</a></li>
	  	<hr />
	  	<li <?=$ressource?>><a href="<?=url?>/ressource"><i class="fa fa-users fa-2x"></i> Ressources</a></li>
	  	<hr />
	  <?php } ?>
	  <li id="numero8"><a href="<?=url?>/deconnexion"><i class="fa fa-cogs fa-2x"></i> Deconnexion</a></li>