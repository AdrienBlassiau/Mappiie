<?php
/**
 * @file reservation2.php
 * 
 * Ce fichier contient le formulaire liée à la réservation de salle via l'emploi du temps
 * 
 */
include "selectionsalle.php";
?>


<br>
<div class="text-center formulaire-haut">
    <h1 class="h1 mb-3 font-weight-normal">Réserver une salle
        <?php
        if (isset($_POST['choix']))
        {
            echo "le ".$_POST['date']." à ".$_POST['heure'];
        }
        ?>
    </h1>
</br>
<?php  
if (!isset($_POST['choix']))
{
    ?>
    <form action="selectiondate.php" method="post">
        <input class="form-control" style="display: inline; max-width: 150px" type="date" name="date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : '' ?>" required> </br>
        <br>
        <input class="form-control" style="display: inline; max-width: 150px" type="text" name="heure" value="<?php echo $_POST['heure'] ?>" required> </br>
     <br>
     <span class="digital">Places min : </span>
     <input class="form-control" style="display: inline; max-width: 150px" name="place" type="number" step="2" value="0" min="0" max="200">
 </br><br>

 <select class="custom-select" name="etage" id="et" required="">
    <option selected value="0">Choisir votre étage:</option>
    <option value="0">Rez-de-Chaussée</option>
    <option value="1">Étage 1</option>
    <option value="2">Étage 2</option>
</select>
</br><br><br>

<input class="bt btn-primary btn-lg btn-primary btn-block" type="submit" name="submit" value="Envoyer"/>
</form>

<?php
}
else
{
    $date= $_POST['date'];
    $choix = $_POST['choix'];
    $heure = $_POST['heure'];
    $place = $_POST['place'];
    ?>  
    <form action="receptionreservation.php" method="post" class="form-signin">

        <input class='form-control' type='text' placeholder='Cliquer sur une salle' id='salle_choisie' name='sc' readonly required=''>
        <br>
        <textarea class='form-control' name='desc' placeholder='Petite description de votre reservation (optionnel)' value="" rows="3" maxlength="200" ></textarea>

        <select class="custom-select" name="statut" id="stat" required>
            <option value="PUBLIC">PUBLIC</option>
            <option value="PRIVÉ">PRIVÉ</option>
        </select>

        <?php 
        echo '<input type="hidden" name="date" value='.$date." ".'/>';
        echo '<input type="hidden" name="heure" value='.$heure." ".'/>';
        ?>
        <br>
        <input class="bt btn-primary btn-lg btn-primary btn-block" type="submit" name="submit" value="Réserver"/>
        <?php

        ?>
    </form>
    <?php
}
?> 

<?php  
if (isset($_POST['reser'])) 
{
    $nbr = $_POST['reser'];

    echo "<p class='succes'> Nombre total de reservation :".$nbr." </p>";
}
?>

</div>


<script>
    function myFunction(entier)
    {
        document.getElementById("salle_choisie").value = entier;
    }
</script>


<canvas id="canvas"></canvas>
<canvas id="canvas2"></canvas>



<?php
if (isset($_POST['choix']))
{
    $test = 0;
    if ($choix=="0")
    {
        include("map0.php");
    }
    else if ($choix=="1")
    {
        include("map1.php");
    }
    else if ($choix=="2")
    {
        include("map2.php");
    }
}
?>

