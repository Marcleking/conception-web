<?php
	class affichageUtilisateurs_model extends TinyMVC_Model
	{
		function AfficherUtilisateurs() {
			$row = $this->db->query('Call Utilisateurs()');
			while($row = $this->db->next())
				$results[] = $row;
			return $results;
			
		}
	}
?>