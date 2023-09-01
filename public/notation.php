<?php
/**
 * @file notation.php
 * 
 * Ce fichier contient la première page de la section du site dédiée à la notation de salles par les utilisateurs. 
 * Si l'utilisateur n'est pas connecté, il n'a pas accès à la page                                                               
 * 
 */

include "vue.php";
include "config.php";
?>

<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <title>MappIIE - Notation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"/>
    <link rel="stylesheet" type="text/css" href="style/style_menu.css">
    <link rel="stylesheet" href="style/mapinteractive.css"/>
    <link rel="stylesheet" href="style/etoile.css"/>

</head>
<body>

    <?php
    create_nav();
    ?>

    <?php 
    if(isset($_SESSION['user']))
    {
        echo '<div class="margin digital">';
        echo "Voici votre espace de notation ".$_SESSION['prenom']." ".$_SESSION['nom'];
        echo '</div>';
        $c=1;
    }
    else
    {
        not_connect();
        $c=0;
    }
    /*Si l'utilisateur est connecté, on lui donne accès à la page*/
    if ($c == 1)
    {
        include("notation2.php");
    }
    create_footer();
    ?>

</body>
</html>