<?php
include "vue.php";
include "config.php";

/**
 * @file changermdp.php
 * 
 * Ce fichier contient l'affichage de la page de changement de mot de passe proposée par le site lorsque l'utilisateur le souhaite. Le nouveau mot de passe doit être rentré deux fois pour le valider                  
 * 
 */
?>

<html>

<head>
  <meta charset="UTF-8"/>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"/>
  <link rel="stylesheet" href= "style/style_menu.css"/>
  <title>
    MappIIE - Changer de mot de passe
  </title>
</head>
<body>

  <?php
  create_nav();

  if(isset($_SESSION['user'])) {

    echo '<div class="text-center formulaire" >';
    echo '<h1 class="h3 mb-3 font-weight-normal" > Changer le mot de passe </h1 ><br >';
    echo '<form method = "post" action = "modificationmdp.php" >';
    echo '    <input placeholder = "Ancien mot de passe" class="form-control" type = "password" name = "mdp" required = "" this . value = "" />';
    echo '    <br />';
    echo '    <input placeholder = "Nouveau mot de passe" class="form-control" type = "password" name = "mdp1" required = "" this . value = "" />';
    echo '    <br />';
    echo '    <input placeholder = "Répéter votre nouveau mot de passe" class="form-control" type = "password" name = "mdp2" this . value = "" required = "" />';
    echo '    <br />';
    echo '    <button type = "submit" class="bt btn btn-lg btn-primary btn-block" > Modifier</button >';

    /*Message de retour indiquant le succes ou l'echec de l'opération*/
    if (isset($_POST['ret2'])) {
      if ($_POST['ret2'] == -1) {
        echo '<p class="erreur"> Nouveau mot de passe trop court ! </p>';
      } else if ($_POST['ret2'] == -2) {
        echo '<p class="erreur"> Mots de passe différents</p>';
      } else if ($_POST['ret2'] == -3) {
        echo '<p class="erreur"> Mot de passe incorrect ! </p>';
      } else if ($_POST['ret2'] == -4) {
        echo '<p class="erreur"> Une erreur innatendue s\'est produite ! </p>';
      } else {
        echo '<p class="succes"> Mot de passe modifié avec succès ! </p>';
      }
    }
  }
  else {
    not_connect();
  }
  ?>
</form>




</div>

<?php
create_footer();
?>


</body>
</html>
