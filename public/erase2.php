<?php
/**
 * @file erase2.php
 * 
 * Ce fichier contient la fonction d'effacement des champs dans la base données liés à la création de cours
* Il contient 1 fonction.
 * 
 * - effacer($val,$id_inter,$id_groupe)                     
 * 
 */

session_start();
include "config.php";

function effacer($val,$id_inter,$id_groupe)
{
	global $connection;
	$req = "DELETE FROM $val WHERE id_groupe='$id_groupe' AND id_inter='$id_inter'";
	/*echo $req;*/
	$connection->exec($req); 
}


$val = $_POST['val'];
$id_inter = $_POST['id_inter'];
$id_groupe = $_POST['id_groupe'];

effacer($val,$id_inter,$id_groupe);

/*Retourne sur la page de l'historique*/
echo '<form name="form" method="post" action="historique.php">';
echo '</form> <script type="text/javascript"> document.form.submit(); </script>';
?>