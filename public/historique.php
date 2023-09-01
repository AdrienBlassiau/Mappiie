<?php
/**
 * @file historique.php
 * 
 * Ce fichier contient la première page de la section du site dédiée à l'historique de réservation, de notation et de création par les utilisateurs. 
 * Si l'utilisateur n'est pas connecté, il n'a pas accès à la page                                                               
 * 
 */
include "vue.php";
include "config.php";
?>


<html>
<head>
    <meta charset="UTF-8"/>
    <title>
        MappIIE - Historique
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"/>
    <!--Enlever pour eviter les conflits-->
    <link rel="stylesheet" href= "style/timetable.css"/>
    <link rel="stylesheet" href="style/style_menu.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="style/style_menu.css">


</head>

<body>
    <?php
    create_nav();
    ?>
    
    <?php 
    if(isset($_SESSION['user']))
    {
        echo '<div class="margin digital">';
        echo 'Voici votre historique '.$_SESSION['prenom']." ".$_SESSION['nom'];
        echo '</div>';
        $c=1;
    }
    else
    {
        not_connect();
        $c=0;
    }

    if ($c == 1)/*Si l'utilisateur est connecté, on lui donne accès à la page*/
    {
        include("historique2.php");
    }
    ?>

    <?php
    create_footer();
    ?>
    
</body>
</html>
