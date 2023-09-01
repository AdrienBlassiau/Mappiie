<?php
/**
 * @file receptionreservation.php
 * 
 * Ce fichier décrit la fonction d'entrée de nouvelles réservations dans la base de données. 
 * Il contient 1 fonction.
 * 
 * - newreservation($id_salle,$date_reservation,$description,$statut)                                  
 * 
 */
session_start();
include("config.php");

/**
 * Fonction qui entre les nouvelles reservations dans la base de données
 * @param   $id_salle         l'identifiant de la salle
 * @param   $date_reservation la date de la reservation
 * @param   $description      la description de la reservation
 * @param   $statut           le statut de la reservation (PRIVE ou PUBLIC)
 * @return                    le nombre de reservations totales
 */
function newreservation($id_salle,$date_reservation,$description,$statut)
{

    global $connection;

    $id = $_SESSION['id'];
    $date=$connection->query("SELECT NOW()");
    $date->setFetchMode(PDO::FETCH_OBJ);
    $date = $date->fetch();
    $date = $date->now;
    $connection->exec("INSERT INTO reservation VALUES('$date','$id',$id_salle,'$date_reservation','$description','$statut')"); 

    $nbr=$connection->query("SELECT COUNT(*) FROM reservation WHERE id_personne = '$id'");
    $nbr->setFetchMode(PDO::FETCH_OBJ);
    $nbr = $nbr->fetch();
    $nbr =  $nbr->count;
    echo $nbr;
    return $nbr; 


}

$id_salle = $_POST['sc'];
$date = $_POST['date'];
$heure = $_POST['heure'];
$date_reservation = $date." ".$heure;
$description = trim($_POST['desc']);
$statut = $_POST['statut'];

$nbr = newreservation($id_salle,$date_reservation,$description,$statut);

/*Retourne le nombre de réservations total afin qu'il vienne s'afficher sous le formulaire*/
echo '<form name="form" method="post" action="reservation.php">';
echo '<input type="hidden" name="reser" value='.$nbr." ".'/>';
echo '</form> <script type="text/javascript"> document.form.submit(); </script>';

?>

