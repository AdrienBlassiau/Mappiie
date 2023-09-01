<?php
/**
 * @file erase.php
 * 
 * Ce fichier contient la fonction d'effacement des champs dans la base données liés au réservation et au notation de salles
* Il contient 1 fonction.
 * 
 * - effacer($val,$res,$champ)                      
 * 
 */
session_start();
include "config.php";

/**
 * fonction qui efface les champs de réservation et notation souhaité
 * @param   $val   La table ou l'on veut effacer des données
 * @param   $res   La valeur du champ que l'on veut effacer
 * @param   $champ Le champ dont on veut effacer une valeur 
 * @return         rien
 */
function effacer($val,$res,$champ)
{
	global $connection;
	$id = $_SESSION['id'];

	$req = "DELETE FROM $val WHERE $champ='$res' AND id_personne='$id'";
	/*echo $req;*/
	$connection->exec($req); 
}


$val = $_POST['val'];
$res = $_POST['res'];
$champ = $_POST['champ'];

effacer($val,$res,$champ);

/*Retourne sur la page de l'historique*/
echo '<form name="form" method="post" action="historique.php">';
echo '</form> <script type="text/javascript"> document.form.submit(); </script>';
?>