<?php 
/**
 * @file selectiondate2.php
 * 
 * Ce fichier retourne au formulaire la date, l'heure et le choix d'étage selectionnés                              
 * 
 */
$heure = $_POST['heure'];
$etage = $_POST['etage'];
$date = new DateTime($_POST['date']);
$date = $date->format('Y-m-d');
?>

<form name="form" method="post" action="creation.php">
	<?php  
	echo '<input type="hidden" name="choix" value='.$etage." ".'/>';
	echo '<input type="hidden" name="date" value='.$date." ".'/>';
	echo '<input type="hidden" name="heure" value='.$heure." ".'/>';
	?>
</form> 

<script type="text/javascript"> 
	document.form.submit();  
</script>


