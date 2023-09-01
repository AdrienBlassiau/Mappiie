<?php
/**
 * Created by PhpStorm.
 * User: kodra
 * Date: 24/04/18
 * Time: 17:05
 */

var_dump($_POST);

require "connect.php";
include "vue.php";

$nom_hote = "";
$nom_user = $_POST["nom"];
$nom_base = "";
$mdp = "";
#db_connect();
?>

<html>
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"/>
    <link rel="stylesheet" href="style/style_menu.css"/>
    <title>
        Mappiie - Réservation
    </title>
</head>

<body>
<? echo '<p>'."$nom_user".'</p>'; ?>
<?
?>
<div class="central">
    <a href="main_menu.php"><h2 class="black">Votre demande a bien été réalisée</h2></a>
</div>
</body>
</html>
