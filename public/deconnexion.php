<?php 
    session_start();
    if (isset($_SESSION['user'])) /*Si tu es connecté, on te déconnecte et on te redirige vers une page.*/
    { 
 
        /*Suppression des variables de session et de la session*/
        $_SESSION = array();
        session_destroy();
 
        /*Suppression des cookies de connexion automatique*/
        setcookie('login', '');
        setcookie('pass_hache', '');
         
        header('Location: index.php?deco=1');
 
    }
    else{ /*Dans le cas contraire on t'empêche d'accéder à cette page en te redirigeant vers la page que tu veux.*/
        echo "pas connecté";
 
    }
?>