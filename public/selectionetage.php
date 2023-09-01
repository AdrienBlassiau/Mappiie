<?php  
/**
 * @file selectionetage.php
 * 
 * Ce fichier retourne au formulaire l'étage selectionné                                                      
 * 
 */
$etage = $_POST['etage']
?>

<form name="form" method="post" action="notation.php">
	<?php
	echo "<input type='text' name='choix' value=".$etage." />"
	?>
</form> 

<script type="text/javascript"> 
	document.form.submit();  
</script>