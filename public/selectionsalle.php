<?php
/**
 * @file selectionsalle.php
 * 
 * Ce fichier teste si une salle doit être sectionnable ou non sur la map interactive(pour les réservations). Si ce n'est pas le cas, elle sera mise par la suite en surbrillance                                       
 * 
 */
include "config.php";

/**
 * Cette fonction teste la validité d'une salle face aux critères entrés par l'utilisateur ainsi que sa disponibilité
 * @param   $id_salle l'identifiant de la salle
 * @param   $date     la date de reservation
 * @param   $place    le nombre de places minimum souhaité
 * @return            si la valeur de retour est > 0, la salle n'est pas retenue
 */
function est_presente($id_salle,$date,$place)
{
	global $connection;
	
	$res1=$connection->query("SELECT * FROM reservation WHERE id_salle=$id_salle AND date_reservation='$date'");
	$res1->setFetchMode(PDO::FETCH_OBJ);
	$nbr2=$res1->rowCount();

	$res2=$connection->query("SELECT * FROM intervention WHERE id_salle=$id_salle AND date_inter='$date'");
	$res2->setFetchMode(PDO::FETCH_OBJ);
	$nbr1=$res2->rowCount();


	$res3=$connection->query("SELECT * FROM salle NATURAL JOIN caracteristiques WHERE id_salle=$id_salle AND nb_places < '$place'");
	$res3->setFetchMode(PDO::FETCH_OBJ);
	$nbr3=$res3->rowCount();

	return $nbr1+$nbr2+$nbr3;
}

?>




