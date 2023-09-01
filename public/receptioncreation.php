<?php
/**
 * @file receptioncreation.php
 * 
 * Ce fichier décrit la fonction d'entrée de nouveaux cours dans la base de données. 
 * Il contient 1 fonction.
 * 
 * - newcreation($module,$prof,$type,$date_reservation,$id_salle)                        
 * 
 */
session_start();
include("config.php");


/**
 * Fonction qui entre les nouvelles créations dans la base de données
 * @param   $module           le module choisi
 * @param   $prof             le professeur choisi
 * @param                     le type de cours choisi(TP, TD ou amphi)
 * @param   $date_reservation la date de la réservation
 * @param   $id_salle         l'identifiant de la salle choisi
 * @return                    le nombre de créations totales
 */
function newcreation($module,$prof,$type,$date_reservation,$id_salle)
{
    global $connection;
    $id = $_SESSION['id'];

    $id_co=$connection->query("SELECT id_inter FROM intervention ORDER BY id_inter DESC");
    $id_co->setFetchMode(PDO::FETCH_OBJ);
    $id_co = $id_co->fetch();
    $id_co = $id_co->id_inter;
    $id_co = $id_co+1;
    echo $id_co." ".$module." ".$id_salle." ".$date_reservation." ".$type." ".$prof." "." ";

    $connection->exec("DELETE FROM reservation WHERE date_reservation='$date_reservation' AND id_salle=$id_salle"); 

    $statement = $connection->prepare("INSERT INTO intervention VALUES($id_co,'$date_reservation','$type','$prof','$module',$id_salle)");
    $statement->execute(); 

    foreach ($_POST['groupe'] as $groupe)
    {
        $statement = $connection->prepare("INSERT INTO cours VALUES('$groupe',$id_co)");
        $statement->execute();

    }

    $nbr1=$connection->query("SELECT COUNT(*) FROM intervention");
    $nbr2=$connection->query("SELECT COUNT(*) FROM cours");
    $nbr1->setFetchMode(PDO::FETCH_OBJ);
    $nbr1 = $nbr1->fetch();
    $nbr1 =  $nbr1->count;

    $nbr2->setFetchMode(PDO::FETCH_OBJ);
    $nbr2 = $nbr2->fetch();
    $nbr2 =  $nbr2->count;
    echo $nbr1;
    echo "\n";
    echo $nbr2;
    return $nbr1; 
}
?>

<?php
$id_salle = $_POST['sc'];
$date = $_POST['date'];
$heure = $_POST['heure'];
$date_reservation = $date." ".$heure;

$module = $_POST['module'];
$prof = $_POST['prof'];
$type = $_POST['type'];
$groupe = $_POST['groupe'];



$nbr = newcreation($module,$prof,$type,$date_reservation,$id_salle);

/*Retourne le nombre de créations total afin qu'il vienne s'afficher sous le formulaire*/
echo '<form name="form" method="post" action="creation.php">';
echo '<input type="hidden" name="crea" value='.$nbr." ".'/>';
echo '</form> <script type="text/javascript"> document.form.submit(); </script>';

?>

