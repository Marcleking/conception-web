<?php
	class modifierutilisateur_model extends TinyMVC_Model
	{
		function modifierUnutilisateur($nom, $prenom, $motPasse, $courriel, $numerocivique, $rue, $ville, $codePostal, $notifHoraire, $notifRemplacement) {

			$row = $this->db->query_one('Call ModifierUtilisateur( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', array($courriel, $nom, $prenom, $motPasse, $numerocivique, $rue, $ville, $codePostal, $notifHoraire, $notifRemplacement));
		
    			$arrayUtil = array (
					"nom"  => $row["nom"],
					"prenom" => $row["prenom"]);
				return $arrayUtil;
		}

		function ajoutTelephone($type, $numero) {
			
			$row = $this->db->query_one('Call AjoutTelephone(?, ?, ?)', array($numero, $type, $_SESSION['user']->getNom()));
			return $row;
		}

		function supprimerTelephone() {
			$this->db->query_one('Call SupprimerTelephone(?)', array($_SESSION['user']->getNom()));
		}
	}
?>