<?php
/**
 * @file selectionsalle2.php
 * 
 * Ce fichier teste si une salle doit être sélectionnable ou non sur la map interactive (pour les créations de l'administrateur). Si ce n'est pas le cas, elle sera mise par la suite en surbrillance                                       
 * 
 */
include "config.php";

/**
 * Cette fonction teste la validité d'une salle selon sa disponibilité
 * @param   $id_salle l'identifiant de la salle
 * @param   $date     la date de reservation
 * @return            si la valeur de retour est > 0, la salle n'est pas retenue
 */
function est_presente($id_salle,$date)
{
    global $connection;
    $res=$connection->query("SELECT * FROM reservation WHERE id_salle=$id_salle AND date_reservation='$date'");
    $res->setFetchMode(PDO::FETCH_OBJ);
    $nbr=$res->rowCount();
    return $nbr;
}

?>




