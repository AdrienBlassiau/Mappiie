<?php
/**
 * @file main_menu.php
 * 
 * Ce fichier affiche la page d'accueil du site avec le nom de la personne ainsi que l'association qu'il préside si c'est le cas et si la personne est connectée                                                       
 * 
 */

include "vue.php";
include "config.php";
include "assoc.php";
?>

<html>
<head lang="fr">
    <meta charset="UTF-8"/>
    <title>
        MappIIE
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="style/style_menu.css">
</head>

<body>

    <?php
    create_nav();
    ?>


    <div class="text-center" style="position: relative; top: 100px; font-size: 100px">
        <?php


        if(isset($_SESSION['user'])) /*Si l'utilisateur est connecté*/
        {
            echo '<span class="digital">Bienvenue ';
            echo $_SESSION['prenom'];
            echo ' ';
            echo $_SESSION['nom'];
            echo '</span>';
            echo '<br>';
            if ($_SESSION['statut']=='Prez')
            {

                boucle_presentation();
            }

        }
        else {/*Sinon on affiche Mappiie*/
            echo '<span class="digital">Bienvenue sur </span><span class="ardestine"><span style="color: #E37E33">M</span><span style="color: #DE5E2D">a</span><span style="color: #DD3728">p</span><span style="color: #D91E3C">p</span><span style="color: #BF2865">I</span><span style="color: #B62A6B">I</span><span style="color: #A42871">E</span></span>';
        }

        ?>
    </div>

    <?php
    create_footer();
    ?>
    
</body>
</html>
