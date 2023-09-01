<?php
/**
 * @file reservation.php
 * 
 * Ce fichier contient la première page de la section du site dédiée à la réservation de salles par les utilisateurs via l'emploi du temps. 
 * Si l'utilisateur n'est pas connecté, il n'a pas accès à la page                                                               
 * 
 */
include "vue.php";
include "config.php";
?>

<html lang='fr'>

<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"/>
    <link rel="stylesheet" href="style/style_menu.css"/>
    <link rel="stylesheet" href="style/mapinteractive.css"/>


    <title>
        MappIIE - Réservation
    </title>
</head>

<body>

    <?php
    create_nav();
    ?>

    <?php 
    if(isset($_SESSION['user']))
    {
        echo '<div class="margin digital">';
        echo 'Voici votre espace de réservation '.$_SESSION['prenom']." ".$_SESSION['nom'];
        echo '</div>';
        $c=1;
    }
    else
    {
        not_connect();
        $c=0;
    }

    if ($c == 1)
    {
        include("reservation3.php");
    }
    create_footer();
    ?>
</body>
</html>
