<?php 
/**
 * @file notation2.php
 * 
 * Ce fichier contient le formulaire lié à la notation de salle
 * 
 */
?>
<br>
<div class="text-center formulaire-haut">
    <h1 class="h1 mb-3 font-weight-normal">Noter une salle</h1>

    <?php
    if (!isset($_POST['choix']))
    {
        ?>
        <br>
        <form action="selectionetage.php" method="post">
            <select class="custom-select" name="etage" id="et" required onchange="changeImage(this.value)">
                <option value="">Choisir votre étage :</option>
                <!--<option value="">Aucun salle</option>-->
                <option value="0">Rez-de-Chaussée</option>
                <option value="1">Étage 1</option>
                <option value="2">Étage 2</option>
            </select>
            <br><br><br><br>
            <input class="bt btn-primary btn-lg btn-primary btn-block" type="submit" name="submit" value="Choisir étage"/>
        </form>

        <?php
    }
    else
    {
        ?>
        <form action="receptionnotation.php" method="post" class="formulaire-haut">

            <input class='form-control' type='text' placeholder='Cliquer sur une salle' id='salle_choisie' name='sc' readonly required=''>

            <br>
            <div class="rating">
                <span class="digital">Luminosité : </span>
                <input type="radio" class="etoile1 hidden" id="lum1" name="lum" required="" value="1">
                <input type="radio" class="etoile2 hidden" id="lum2" name="lum" required="" value="2">
                <input type="radio" class="etoile3 hidden" id="lum3" name="lum" required="" value="3">
                <input type="radio" class="etoile4 hidden" id="lum4" name="lum" required="" value="4">
                <input type="radio" class="etoile5 hidden" id="lum5" name="lum" required="" value="5">

                <label id="llum5" for="lum5" class="letoile5 letoile">y</label>
                <label id="llum4" for="lum4" class="letoile4 letoile">y</label>
                <label id="llum3" for="lum3" class="letoile3 letoile">y</label>
                <label id="llum2" for="lum2" class="letoile2 letoile">y</label>
                <label id="llum1" for="lum1" class="letoile1 letoile">y</label>

            </div>
            <br>
            <div class="rating">
                <span class="digital">Accès handicapé : </span>
                <input type="radio" class="etoile1 hidden" id="hand1" name="hand" required="" value="1">
                <input type="radio" class="etoile2 hidden" id="hand2" name="hand" required="" value="2">
                <input type="radio" class="etoile3 hidden" id="hand3" name="hand" required="" value="3">
                <input type="radio" class="etoile4 hidden" id="hand4" name="hand" required="" value="4">
                <input type="radio" class="etoile5 hidden" id="hand5" name="hand" required="" value="5">

                <label id="lhand5" for="hand5" class="letoile5 letoile">y</label>
                <label id="lhand4" for="hand4" class="letoile4 letoile">y</label>
                <label id="lhand3" for="hand3" class="letoile3 letoile">y</label>
                <label id="lhand2" for="hand2" class="letoile2 letoile">y</label>
                <label id="lhand1" for="hand1" class="letoile1 letoile">y</label>

            </div>
            <br>
            <div class="rating">
                <span class="digital">Propreté : </span>
                <input type="radio" class="etoile1 hidden" id="prop1" name="prop" required="" value="1">
                <input type="radio" class="etoile2 hidden" id="prop2" name="prop" required="" value="2">
                <input type="radio" class="etoile3 hidden" id="prop3" name="prop" required="" value="3">
                <input type="radio" class="etoile4 hidden" id="prop4" name="prop" required="" value="4">
                <input type="radio" class="etoile5 hidden" id="prop5" name="prop" required="" value="5">

                <label id="lprop5" for="prop5" class="letoile5 letoile">y</label>
                <label id="lprop4" for="prop4" class="letoile4 letoile">y</label>
                <label id="lprop3" for="prop3" class="letoile3 letoile">y</label>
                <label id="lprop2" for="prop2" class="letoile2 letoile">y</label>
                <label id="lprop1" for="prop1" class="letoile1 letoile">y</label>
            </div>
            <br>
            <div class="rating">
                <span class="digital">Note : </span>
                <input type="radio" class="etoile1 hidden" id="note1" name="note" required="" value="1">
                <input type="radio" class="etoile2 hidden" id="note2" name="note" required="" value="2">
                <input type="radio" class="etoile3 hidden" id="note3" name="note" required="" value="3">
                <input type="radio" class="etoile4 hidden" id="note4" name="note" required="" value="4">
                <input type="radio" class="etoile5 hidden" id="note5" name="note" required="" value="5">

                <label id="lnote5" for="note5" class="letoile5 letoile">y</label>
                <label id="lnote4" for="note4" class="letoile4 letoile">y</label>
                <label id="lnote3" for="note3" class="letoile3 letoile">y</label>
                <label id="lnote2" for="note2" class="letoile2 letoile">y</label>
                <label id="lnote1" for="note1" class="letoile1 letoile">y</label>
            </div>
            <br>
            <?php ?>
            <button class="bt btn btn-lg btn-primary btn-block" type="submit">Noter</button>
        </form>

        <?php
    }
    ?>

    <?php
    if (isset($_POST['nota'])) {
        $nbr = $_POST['nota'];
        echo '<p class="succes">'."Nombres de notations entrées : ".$nbr.'</p>';
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
    $choix = $_POST['choix'];
    $test = 1;
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
