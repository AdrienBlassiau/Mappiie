<?php 
/**
 * @file selectiondate.php
 * 
 * Ce fichier retourne au formulaire la date, l'heure, le choix d'étage et le nombre de place minimum selectionné                        
 * 
 */
$heure = $_POST['heure'];
$etage = $_POST['etage'];
$date = new DateTime($_POST['date']);
$date = $date->format('Y-m-d');
$place = $_POST['place'];
?>

<form name="form" method="post" action="reservation.php">
	<?php  
	echo '<input type="hidden" name="choix" value='.$etage." ".'/>';
	echo '<input type="hidden" name="date" value='.$date." ".'/>';
	echo '<input type="hidden" name="heure" value='.$heure." ".'/>';
	echo '<input type="hidden" name="place" value='.$place." ".'/>';
	?>
</form> 

<script type="text/javascript"> 
	document.form.submit();  
</script>


