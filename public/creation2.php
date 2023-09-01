<?php
/**
 * @file creation.php
 * 
 * Ce fichier contient les tableaux d'historique de reservation, création et notation, en fonction du statut de l'utilisateur connecté
 * 
 */

include "selectionsalle2.php";
?>

<br>
<div class="text-center formulaire-haut">
    <h1 class="h1 mb-3 font-weight-normal">Créer un cours
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

    <form action="selectiondate2.php" method="post">
        <label for="date">Date</label>
        <input class="form-control" style="display: inline; max-width: 150px" type="date" name="date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : '' ?>" required> </br>
        <br>
        <label for="heure">Heure</label>
        <select class="custom-select select-text" name="heure" id="heure" required="">
            <option autofocus value="09:00:00">09:00:00</option>
            <option value="11:00:00">11:00:00</option>
            <option value="14:00:00">14:00:00</option>
            <option value="16:00:00">16:00:00</option>
        </select>  </br><br>
</br>
<select class="custom-select" name="etage" id="et" required>
    <option value="">Choisir votre étage:</option>
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
    $date = $date." ".$heure;
    ?>  
    <form action="receptioncreation.php" method="post" class="formulaire-haut">

        <input class='form-control' type='text' placeholder='Cliquer sur une salle' id='salle_choisie' name='sc' readonly required=''>

    </br>
    <label for="type">Type : </label>
    <select class="custom-select select-text" name="type" id="type"  required="">
        <option value="COURS">COURS</option>
        <option value="TD">TD</option>
        <option value="TP">TP</option>
    </select>
    <br>
    <label for="prof">Professeur : </label>
    <select class="custom-select select-text" name="prof" id="prof"  required="">
        <?
        $prof = listeprof();
        while($ligne = $prof->fetch() ) {
            echo "<option value=\"$ligne->id_professeur\">"."$ligne->nom".'</option>';
        }
        ?>
    </select>
    <br>
    <label for="prof">Module : </label>
    <select class="custom-select select-text" name="module" id="module"  required="">
        <?
        $module = listemodule();
        while($ligne = $module->fetch() ) {
            echo "<option value=\"$ligne->id_module\">"."$ligne->id_module".'</option>';
        }
        ?>
    </select>
    <br>
    <label for="prof">Groupe : </label>
    <select class="custom-select select-number" name="groupe[]" id="groupe"  required="" multiple>
        <?
        $groupe = listegroupe();
        while($ligne = $groupe->fetch() ) {
            echo "<option value=\"$ligne->id_groupe\">"."$ligne->id_groupe".'</option>';
        }
        ?>
    </select>
    <br>
    <?php
    echo '<input type="hidden" name="date" value='.$date." ".'/>';
    echo '<input type="hidden" name="heure" value='.$heure." ".'/>';
    ?>
        <br>
    <input class="bt btn-primary btn-lg btn-primary btn-block" type="submit" name="submit" value="Créer"/>
    <?php

    ?>
</form>
<?php
}
?> 

<?php  
if (isset($_POST['crea'])) 
{
    $nbr = $_POST['crea'];

    echo "<p class='succes'> Nombre totale de créations :".$nbr." </p>";
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

