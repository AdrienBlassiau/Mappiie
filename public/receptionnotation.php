<?php
/**
 * @file receptionnotation.php
 * 
 * Ce fichier décrit la fonction d'entrée de nouvelles notations dans la base de données. 
 * Il contient 1 fonction.
 * 
 * - newrating($lum,$hand,$prop,$sc,$note)                                                                 
 * 
 */
session_start();
include("config.php");


/**
 * Fonction qui entre les nouvelles notations dans la base de données
 * @param   $lum  la luminosité de la salle notée sur 5
 * @param   $hand l’accès handicap de la salle notée sur 5
 * @param   $prop la propreté de la salle notée sur 5
 * @param   $sc   l'identifiant de la salle notée sur 5
 * @param   $note la note globale attribuée à la salle
 * @return        le nombre de notations totales
 */
function newrating($lum,$hand,$prop,$sc,$note)
{

    global $connection;

    $id = $_SESSION['id'];


    $date=$connection->query("SELECT NOW()");
    $date->setFetchMode(PDO::FETCH_OBJ);
    $date = $date->fetch();
    $date = $date->now;

    $statement = $connection->prepare("INSERT INTO note VALUES('$date','$id',$sc,$note,$lum,$hand,$prop)");
    $statement->execute();  
    $nbr=$connection->query("SELECT COUNT(*) FROM note WHERE id_personne = '$id'");
    $nbr->setFetchMode(PDO::FETCH_OBJ);
    $nbr = $nbr->fetch();
    $nbr =  $nbr->count;
    return $nbr; 


}
?>

<?php
$lum = $_POST['lum'];
$hand = $_POST['hand'];
$prop = $_POST['prop'];
$sc = $_POST['sc'];
$note = $_POST['note'];
$nbr = newrating($lum,$hand,$prop,$sc,$note);

/*Retourne le nombre de notations total afin qu'il vienne s'afficher sous le formulaire*/
echo '<form name="form" method="post" action="notation.php">';
echo '<input type="hidden" name="nota" value='.$nbr." ".'/>';;
echo '</form> <script type="text/javascript"> document.form.submit(); </script>';

?>

