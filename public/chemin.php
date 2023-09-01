<?php
include "vue.php";
include "config.php";

/**
 * @file chemin.php
 * 
 * Ce fichier contient l'appel de l'affichage de la carte d'itinéraire interactive pour la recherche de chemin si l'utilisateur est connecté
 *  
 */
?>

<html lang='fr'>

<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"/>
    <link rel="stylesheet" href="style/style_menu.css"/>
    <link rel="stylesheet" href="style/chemin.css"/>

    <title>
        MappIIE - Chercher son chemin
    </title>
</head>

<body>

    <?php
    create_nav();
    ?>

    <?php 
    if(isset($_SESSION['user']))/*Pas d'utilisateur connecté, un message invite à le faire*/
    {
        echo '<div class="margin digital">';
        echo 'Voici votre espace de recherche d\'itinéraire '.$_SESSION['prenom']." ".$_SESSION['nom'];
        echo '</div>';
        $c=1;
    }
    else/*Un utilisateur est connecté, on affiche la carte*/
    {
        not_connect();
        $c=0;
    }

    if ($c == 1)
    {
        include("chemin2.php");
    }
    create_footer();
    ?>
</body>
</html>
