<?php
include "vue.php";
include "config.php";

/**
 * @file auth.php
 * 
 * Ce fichier contient l'affichage de la page d'authentification ainsi que les messages indiquant si la connexion est réussie ou non
 *  
 */
?>

<html>

<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"/>
    <link rel="stylesheet" href= "style/style_menu.css"/>
    <link rel="stylesheet" href= "style/auth.css"/>
    <title>
        MappIIE - Authentification
    </title>
</head>
<body>

    <?php
    create_nav();
    ?>

    <div class="center formulaire text-center">
        <h1 class="h3 mb-3 font-weight-normal">Connectez-vous</h1><br>

        <form method="post" action="connexion.php">
            <input placeholder="Identifiant" class="form-control digital" type="text" name="login" required=""/>
            <br/>
            <input placeholder="Mot de passe" class="form-control digital" type="password" name="mdp" required=""/>
            <br/>
            <?php
            /*Message de retour indiquant le succes ou l'echec de l'opération*/
            if (isset($_POST['ret'])) {
                if ($_POST['ret'] == -1) {
                    echo '<p class="erreur"> Identifiant ou mot de passe incorrect </p>';
                }
                else{
                    echo '<p class="succes"> Connexion reussie ! </p>';
                }
            }
            ?>
            <button type="submit" class="bt btn btn-lg btn-primary btn-block anim_button"><span>Connexion</span></button><br>
        </form>
    </div>
    <?php
    create_footer()
    ?>

</body>
</html>