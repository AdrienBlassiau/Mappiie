<?php
/**
 * @file vue.php
 * 
 * Ce fichier contient l'affichage de la bannière du site avec l'ensemble des features proposées par Mappiie                                                             
 * 
 */

session_start();

/**
 * Création du bandeau en fonction du statut de l'utilisateur
 * @return rien
 */
function create_nav()
{
    $page = basename($_SERVER['PHP_SELF']);

    $class = array('ainnot','ainnot','ainnot','ainnot','ainnot','ainnot','ainnot');

    switch ($page){
        case "table.php":
        case "timetable.php":
        $class[0]='ain2';
        break;
        case "chemin.php":
        $class[1]='ain3';
        break;
        case "reservation.php":
        case "creation.php":
        $class[2]='ain4';
        break;
        case "notation.php":
        $class[3]='ain5';
        break;
        case "historique.php":
        $class[4]='ain6';
        break;
        case "changermdp.php":
        $class[5]='ain7';
        break;
        case "deconnexion.php":
        case "auth.php":
        $class[6]='ain8';
        break;
        default :
        break;
    }


    echo"<nav>";
    echo"<a id='img' href=\"main_menu.php\"><img id='image' src='image/logo.png' onmouseenter=\"this.setAttribute('src', 'image/logo_halo.png');\" onmouseleave=\"this.setAttribute('src', 'image/logo.png');\" alt=\"logo\" height=\"100\" width=\"208\"/></a>";
    
    if (isset($_SESSION['user'])) {
        echo "<a class={$class[0]} href=\"table.php\">Emploi du temps</a>";
    }
    else {
        echo "<a class={$class[0]} href=\"timetable.php\">Emploi du temps</a>";
    }
    echo "<a class={$class[1]} href=\"chemin.php\">Chemin</a>";
    if (isset($_SESSION['user'])) {
        if($_SESSION['statut'] == "Administrateur")
        {
            echo "<a class={$class[2]} href=\"creation.php\">Création</a>";
        }  
        else {
            echo "<a class={$class[2]} href=\"reservation.php\">Réservation</a>";
        }      
    }
    else {
        echo "<a class={$class[2]} href=\"reservation.php\">Réservation</a>";
    }
    echo "<a class={$class[3]} href=\"notation.php\">Notation</a>";
    echo "<a class={$class[4]} href=\"historique.php\">Historique</a>";
    echo "<a class={$class[5]} href=\"changermdp.php\">Compte</a>";
    if (isset($_SESSION['user'])) {
        echo "<a class={$class[6]} href=\"deconnexion.php\">Déconnexion</a>";
    }
    else {
        echo "<a class={$class[6]} href=\"auth.php\">Connexion</a>";
    }
    echo"<div class=\"animation start-home\"></div>";
    echo"</nav>";
}

/**
 * Création du pied de page avec le nom de notre groupe ainsi que le copyright
 * @return rien
 */
function create_footer() {
    echo '<br>';
    echo '<footer class="site-footer">';
    if (isset($_SESSION['statut'])) {
        echo '<span class="footer-right">Session ';
        echo $_SESSION['statut'];
        echo '</span>';
    }
    echo '<span class="footer-left"> Copyright © 2018 Made_By_Arise</span>';
    echo '</footer>';
}

/**
 * Création du message indiquant à l'utilisateur qu'il n'est pas connecté
 * @return rien
 */
function not_connect() {
    echo "<div class='center text-center'>";
    echo "<p class='not-connect'>Vous ne pouvez pas accéder à cette page car vous n'êtes pas connecté</p>";
    echo "<br>";
    echo "<br>";
    echo "<a href='auth.php'> <button class='bt btn btn-lg btn-primary btn-block anim_button' style='width:300px; position: relative; left: 50%; transform: translate(-50%, 0%);' onclick=''><span>Connectez-vous !</span></button></a>";
    echo "</div>";
}

?>