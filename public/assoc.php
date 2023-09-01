<?php
include "config.php";

/**
 * @file assoc.php
 * 
 * Ce fichier décrit l'ensemble des fonctions d'affichage de messages supplémentaires lors de l'accueil de l'utilisateur. 
 * Il contient 2 fonctions.
 * 
 * - recherche_assoc_image() 								
 * - boucle_presentation() 									
 * 
 */

/**
 * Fonction qui renvoie le résultat d'une requête correspondant à la recherche
 * de la photo de l'association d'un prez. Lors de l'appel de cette fonction, on sait que l'utilisateur est un prez.
 * @return la requête correspondante
 */
function recherche_assoc_image()
{
	global $connection;
	$id = $_SESSION['id'];
	$res=$connection->query("SELECT nom_assoc,image FROM association WHERE id_prez='$id'");
	$res->setFetchMode(PDO::FETCH_OBJ);
	return $res;
}

/**
 * Boucle qui affiche un texte supplémentaire ainsi qu'une image si l'utilisateur est un président d'association
 * @return rien
 */
function boucle_presentation()
{
	$assoc = recherche_assoc_image();

	while($ligne = $assoc->fetch())
	{
		echo "<br>";
		echo "<span class='h1'>";
		echo "Prez ".$ligne->nom_assoc;
		echo "</span>";
		echo "<br>";
		$image = $ligne->image;
		if ($image != 'none')/*Si l'association possède un sigle, on l'affiche*/
		{			
			echo "<img class='img-logo' src='image/".$image."' >";
			echo "<br>";
		}
	}

}
?>