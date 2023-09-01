<div id="requete" class="text-center formulaire">
    <form action="functionReservation.php" method="post" class="form-signin">
        <h1 class="h3 mb-3 font-weight-normal">Entrez votre réservation</h1><br>
        <?php
        echo "<input placeholder=\"Cliquer sur une salle\" id='$salle_choisie' type=\"text\" name=\"sc\" required=\"\">";
        ?>
        </br>
        <label class="sr-only" for="date">Date</label>
        <div class="row">

            <div class ="col-md-6 mb-2">
                <label for="annee">Année</label>
                <select name="annee" id="annee" class="custom-select d-block w-100" required="">
                    <?
                    for ($i = 2017; $i < 32; $i++) {
                        echo "<option value=\"$i\">"."$i".'</option>';
                    }
                    ?>
                </select>
                <label for="month">Month</label>
                <select name="mois" id="month" class="custom-select d-block w-100" required="">
                    <option value="jan">01</option>
                    <option value="feb">02</option>
                    <option value="mar">03</option>
                    <option value="apr">04</option>
                    <option value="may">05</option>
                    <option value="jun">06</option>
                    <option value="jul">07</option>
                    <option value="aug">08</option>
                    <option value="sep">09</option>
                    <option value="oct">10</option>
                    <option value="nov">11</option>
                    <option value="dec">12</option>
                </select>
            </div>
            <div class="col-md-6 mb-2">
                <label for="day">Day</label>
                <select name="jour" id="day" class="custom-select d-block w-100" required="">
                    <?
                    for ($i = 1; $i < 32; $i++) {
                        echo "<option value=\"$i\">"."$i".'</option>';
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="bt btn btn-lg btn-primary btn-block">Enregistrer</button>
        </form>
    </div>