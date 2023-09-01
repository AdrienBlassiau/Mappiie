<?php 
/**
 * @file historique2.php
 * 
 * Ce fichier contient les tableaux liés à l'historique des notations, réservations et créations
 * 
 */
?>
<div style="position: relative; top: 20px;">

    <?php  
    if ($_SESSION['statut']=="God")/*SuperUser qui peut tout effacer*/
    {
        ?>
        <div class="container">
            <h1 class="h1">Historique des créations</h1>
            <table class="table table-bordered table-hover table-striped rounded">
                <thead style="font-weight: bold">
                    <td>Id</td>
                    <td>Type</td>
                    <td>Professeur</td>
                    <td>Groupe</td>
                    <td>Module</td>
                    <td>Salle</td>
                    <td>Date de l'intervention</td>
                </thead>
                <?php 
                $table = "cours";
                $resultats=$connection->query("SELECT * FROM intervention NATURAL JOIN cours");
                $resultats->setFetchMode(PDO::FETCH_OBJ);
                $nbr1=$resultats->rowCount();
                if ($nbr1 != 0) {
                    while( $ligne = $resultats->fetch() )
                    {

                        $prof=$connection->query("SELECT nom FROM personne NATURAL JOIN professeur WHERE id_personne='$ligne->id_professeur'");
                        $prof->setFetchMode(PDO::FETCH_OBJ);
                        $col = $prof->fetch();
                        $prof = $col->nom;
                        echo "<tr>";
                        echo "<td>".$ligne->id_inter."</td>";
                        echo "<td>".$ligne->type."</td>";
                        echo "<td>".$prof."</td>";
                        echo "<td>".$ligne->id_groupe."</td>";
                        echo "<td>".$ligne->id_module."</td>";
                        echo "<td>".$ligne->id_salle."</td>";
                        echo "<td>".$ligne->date_inter."</td>";
                        echo "<td> <form action='erase2.php' method='post' class='form-signin' />";
                        echo "<input type='hidden' name='val' value=\"".$table."\" />";
                        echo "<input type='hidden' name='id_inter' value=\"".$ligne->id_inter."\" />";
                        echo "<input type='hidden' name='id_groupe' value=\"".$ligne->id_groupe."\" />";
                        echo "<input class='bt btn-primary btn-lg btn-primary btn-block' type='submit' name='submit' value='Annuler'/>";
                        echo "</form> </td>";
                        echo "</tr>";
                    }
                }
                $resultats->closeCursor();
                ?>
            </table>
        </div>

        <div class="container">
            <h1 class="h1">Historique des notations</h1>
            <table class="table table-bordered table-hover table-striped rounded">
                <thead style="font-weight: bold">
                    <td>Nom</td>
                    <td>Prénom</td>
                    <td>Date du dépôt</td>
                    <td>Numéro de la salle</td>
                    <td>Note attribuée</td>
                    <td>Note luminosité</td>
                    <td>Note accès handicapé</td>
                    <td>Note propreté</td>
                    <td>Annuler</td>
                </thead>
                <?php 
                $id = $_SESSION['id'];
                $table = "note";
                $resultats=$connection->query("SELECT * FROM note NATURAL JOIN personne ORDER BY nom");
                $resultats->setFetchMode(PDO::FETCH_OBJ);
                $nbr1=$resultats->rowCount();
            //echo "\n".$nbr2;
                if ($nbr1 != 0) {
                    while( $ligne = $resultats->fetch() )
                    {
                        echo "<tr>";
                        echo "<td>".$ligne->nom."</td>";
                        echo "<td>".$ligne->prenom."</td>";
                        echo "<td>".$ligne->date_not."</td>";
                        echo "<td>".$ligne->id_salle."</td>";
                        echo "<td>".$ligne->luminosite."</td>";
                        echo "<td>".$ligne->acces_hand."</td>";
                        echo "<td>".$ligne->proprete."</td>";
                        echo "<td>".$ligne->note_sur_5."</td>";
                        echo "<td> <form action='erase.php' method='post' class='form-signin' />";
                        echo "<input type='hidden' name='val' value=\"".$table."\" />";
                        echo "<input type='hidden' name='res' value=\"".$ligne->date_not."\" />";
                        echo "<input type='hidden' name='champ' value='date_not' />";
                        echo "<input class='bt btn-primary btn-lg btn-primary btn-block' type='submit' name='submit' value='Annuler'/>";
                        echo "</form> </td>";
                        echo "</tr>";
                    }
                }
                $resultats->closeCursor();
                ?>
            </table>
        </div>


        <div class="container">
            <h1 class="h1">Historique des réservations</h1>
            <table class="table table-bordered table-hover table-striped rounded">
                <thead style="font-weight: bold">
                    <td>Nom</td>
                    <td>Prénom</td>
                    <td>Date du dépôt</td>
                    <td>Salle réservée</td>
                    <td>Date de la réservation</td>
                    <td>Description</td>
                    <td>Statut</td>
                    <td>Annuler</td>
                </thead>
                <?php 
                $log = $_SESSION['user'];
                $table = "reservation";
                $id = $_SESSION['id'];
                $resultats=$connection->query("SELECT * FROM reservation NATURAL JOIN personne ORDER BY nom");
                $resultats->setFetchMode(PDO::FETCH_OBJ);
                $nbr1=$resultats->rowCount();
            //echo "\n".$nbr2;
                if ($nbr1 != 0) {
                    while( $ligne = $resultats->fetch() )
                    {
                        echo "<tr>";
                        echo "<td>".$ligne->nom."</td>";
                        echo "<td>".$ligne->prenom."</td>";
                        echo "<td>".$ligne->date_hist_res."</td>";
                        echo "<td>".$ligne->id_salle."</td>";
                        echo "<td>".$ligne->date_reservation."</td>";
                        echo "<td>".htmlspecialchars($ligne->description)."</td>";
                        echo "<td>".$ligne->statut."</td>";
                        echo "<td> <form action='erase.php' method='post' class='form-signin' />";
                        echo "<input type='hidden' name='val' value=\"".$table."\" />";
                        echo "<input type='hidden' name='res' value=\"".$ligne->date_hist_res."\" />";
                        echo "<input type='hidden' name='champ' value='date_hist_res' />";
                        echo "<input class='bt btn-primary btn-lg btn-primary btn-block' type='submit' name='submit' value='Annuler'/>";
                        echo "</form> </td>";
                        echo "</tr>";
                    }
                }
                $resultats->closeCursor();
                ?>
            </table>
        </div>


        <?php  
    }
    else if ($_SESSION['statut']=="Administrateur")/*Admin qui peut créer et effacer n'importe quels cours*/
    {

        ?>

        <div class="container">
            <h1 class="h1">Historique des notations</h1>
            <table class="table table-bordered table-hover table-striped rounded">
                <thead style="font-weight: bold">
                    <td>Date du dépôt</td>
                    <td>Numéro de la salle</td>
                    <td>Note attribuée</td>
                    <td>Note luminosité</td>
                    <td>Note accès handicapé</td>
                    <td>Note propreté</td>
                    <td>Annuler</td>
                </thead>
                <?php 
                $id = $_SESSION['id'];
                $table = "note";
                $resultats=$connection->query("SELECT date_not,id_salle,note_sur_5,luminosite,acces_hand,proprete FROM note  WHERE id_personne='$id' ORDER BY date_not desc");
                $resultats->setFetchMode(PDO::FETCH_OBJ);
                $nbr1=$resultats->rowCount();
            //echo "\n".$nbr2;
                if ($nbr1 != 0) {
                    while( $ligne = $resultats->fetch() )
                    {
                        echo "<tr>";
                        echo "<td>".$ligne->date_not."</td>";
                        echo "<td>".$ligne->id_salle."</td>";
                        echo "<td>".$ligne->luminosite."</td>";
                        echo "<td>".$ligne->acces_hand."</td>";
                        echo "<td>".$ligne->proprete."</td>";
                        echo "<td>".$ligne->note_sur_5."</td>";
                        echo "<td> <form action='erase.php' method='post' class='form-signin' />";
                        echo "<input type='hidden' name='val' value=\"".$table."\" />";
                        echo "<input type='hidden' name='res' value=\"".$ligne->date_not."\" />";
                        echo "<input type='hidden' name='champ' value='date_not' />";
                        echo "<input class='bt btn-primary btn-lg btn-primary btn-block' type='submit' name='submit' value='Annuler'/>";
                        echo "</form> </td>";
                        echo "</tr>";
                    }
                }
                $resultats->closeCursor();
                ?>
            </table>
        </div>

        <div class="container">
            <h1 class="h1">Historique des créations</h1>
            <table class="table table-bordered table-hover table-striped rounded">
                <thead style="font-weight: bold">
                    <td>Id</td>
                    <td>Type</td>
                    <td>Professeur</td>
                    <td>Groupe</td>
                    <td>Module</td>
                    <td>Salle</td>
                    <td>Date de l'intervention</td>
                </thead>
                <?php 
                $table = "cours";
                $resultats=$connection->query("SELECT * FROM intervention NATURAL JOIN cours");
                $resultats->setFetchMode(PDO::FETCH_OBJ);
                $nbr1=$resultats->rowCount();
                if ($nbr1 != 0) {
                    while( $ligne = $resultats->fetch() )
                    {

                        $prof=$connection->query("SELECT nom FROM personne NATURAL JOIN professeur WHERE id_personne='$ligne->id_professeur'");
                        $prof->setFetchMode(PDO::FETCH_OBJ);
                        $col = $prof->fetch();
                        $prof = $col->nom;
                        echo "<tr>";
                        echo "<td>".$ligne->id_inter."</td>";
                        echo "<td>".$ligne->type."</td>";
                        echo "<td>".$prof."</td>";
                        echo "<td>".$ligne->id_groupe."</td>";
                        echo "<td>".$ligne->id_module."</td>";
                        echo "<td>".$ligne->id_salle."</td>";
                        echo "<td>".$ligne->date_inter."</td>";
                        echo "<td> <form action='erase2.php' method='post' class='form-signin' />";
                        echo "<input type='hidden' name='val' value=\"".$table."\" />";
                        echo "<input type='hidden' name='id_inter' value=\"".$ligne->id_inter."\" />";
                        echo "<input type='hidden' name='id_groupe' value=\"".$ligne->id_groupe."\" />";
                        echo "<input class='bt btn-primary btn-lg btn-primary btn-block' type='submit' name='submit' value='Annuler'/>";
                        echo "</form> </td>";
                        echo "</tr>";
                    }
                }
                $resultats->closeCursor();
                ?>
            </table>
        </div>



        <?php  
    }
    else
    {  
        ?>

        <div class="container">
            <h1 class="h1">Historique des notations</h1>
            <table class="table table-bordered table-hover table-striped rounded">
                <thead style="font-weight: bold">
                    <td>Date du dépôt</td>
                    <td>Numéro de la salle</td>
                    <td>Note attribuée</td>
                    <td>Note luminosité</td>
                    <td>Note accès handicapé</td>
                    <td>Note propreté</td>
                    <td>Annuler</td>
                </thead>
                <?php 
                $id = $_SESSION['id'];
                $table = "note";
                $resultats=$connection->query("SELECT * FROM note  WHERE id_personne='$id' ORDER BY date_not desc");
                $resultats->setFetchMode(PDO::FETCH_OBJ);
                $nbr1=$resultats->rowCount();
            //echo "\n".$nbr2;
                if ($nbr1 != 0) {
                    while( $ligne = $resultats->fetch() )
                    {
                        echo "<tr>";
                        echo "<td>".$ligne->date_not."</td>";
                        echo "<td>".$ligne->id_salle."</td>";
                        echo "<td>".$ligne->luminosite."</td>";
                        echo "<td>".$ligne->acces_hand."</td>";
                        echo "<td>".$ligne->proprete."</td>";
                        echo "<td>".$ligne->note_sur_5."</td>";
                        echo "<td> <form action='erase.php' method='post' class='form-signin' />";
                        echo "<input type='hidden' name='val' value=\"".$table."\" />";
                        echo "<input type='hidden' name='res' value=\"".$ligne->date_not."\" />";
                        echo "<input type='hidden' name='champ' value='date_not' />";
                        echo "<input class='bt btn-primary btn-lg btn-primary btn-block' type='submit' name='submit' value='Annuler'/>";
                        echo "</form> </td>";
                        echo "</tr>";
                    }
                }
                $resultats->closeCursor();
                ?>
            </table>
        </div>


        <div class="container">
            <h1 class="h1">Historique des réservations</h1>
            <table class="table table-bordered table-hover table-striped rounded">
                <thead style="font-weight: bold">
                    <td>Date du dépôt</td>
                    <td>Salle réservée</td>
                    <td>Date de la réservation</td>
                    <td>Description</td>
                    <td>Statut</td>
                    <td>Annuler</td>
                </thead>
                <?php 
                $log = $_SESSION['user'];
                $table = "reservation";
                $id = $_SESSION['id'];
                $resultats=$connection->query("SELECT * FROM reservation WHERE id_personne='$id' ORDER BY date_hist_res desc");
                $resultats->setFetchMode(PDO::FETCH_OBJ);
                $nbr1=$resultats->rowCount();
            //echo "\n".$nbr2;
                if ($nbr1 != 0) {
                    while( $ligne = $resultats->fetch() )
                    {
                        echo "<tr>";
                        echo "<td>".$ligne->date_hist_res."</td>";
                        echo "<td>".$ligne->id_salle."</td>";
                        echo "<td>".$ligne->date_reservation."</td>";
                        echo "<td>".$ligne->description."</td>";
                        echo "<td>".$ligne->statut."</td>";
                        echo "<td> <form action='erase.php' method='post' class='form-signin' />";
                        echo "<input type='hidden' name='val' value=\"".$table."\" />";
                        echo "<input type='hidden' name='res' value=\"".$ligne->date_hist_res."\" />";
                        echo "<input type='hidden' name='champ' value='date_hist_res' />";
                        echo "<input class='bt btn-primary btn-lg btn-primary btn-block' type='submit' name='submit' value='Annuler'/>";
                        echo "</form> </td>";
                        echo "</tr>";
                    }
                }
                $resultats->closeCursor();
                ?>
            </table>
        </div>

        <?php  
    } 
    ?>
</div>