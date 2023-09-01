<?php
/**
 * @file timetable.php
 * 
 * Ce fichier contient le choix des groupes pour l'affichage de l'emploi du temps pour les utilisateurs non connectés                                                          
 * 
 */
include "vue.php";
include "config.php";
?>
<html>

<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"/>
    <link rel="stylesheet" href="style/style_menu.css"/>
    <title>
       MappIIE - Emploi du temps
   </title>
</head>
<body>
    <?php
    create_nav();
    ?>
    <div class="text-center formulaire">
        <form method="post" action="table.php">
            <input class="form-control" placeholder="Identifiant" type="text" name="login"/>
            <br/>
            <div style="left:50%;transform: translate(-50%, 0%);" class="col-md-6 mb-2">
                <label  class="digital" for="groupe">Groupe</label>
                <select name="groupe" id="groupe" class="rounded custom-select d-block w-100">
                    <option value="1.1">1.1</option> 
                    <option value="1.2">1.2</option> 
                    <option value="2.1">2.1</option> 
                    <option value="2.2">2.2</option> 
                    <option value="3.1">3.1</option> 
                    <option value="3.2">3.2</option> 
                    <option value="4.1">4.1</option> 
                    <option value="4.2">4.2</option> 
                </select>
            </div>
            <br/>
            <input class="bt btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Chercher"/>
        </form>
    </div>


    <?php
    create_footer();
    ?>


</body>



</html>