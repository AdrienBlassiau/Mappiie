<?php
/**
 * @file connexion.php
 * 
 * Ce fichier décrit la fonction de connexion de l'utilisateur au site. 
 * Il contient 1 fonction.
 * 
 * - auth($user,$mdp)                                                                  
 * 
 */

session_start();
include("config.php");

$user= $_POST['login'];
$mdp = $_POST['mdp'];

/**
 * Fonction de connexion de l'utilsateur au site, renvoie 0 si la connexion est réussie et -1 sinon
 * @param   $user le login entré
 * @param   $mdp  le mot de passe rentré
 * @return        0 si réussite, -1 sinon
 */
function auth($user,$mdp)
{

    global $connection;
    $res=$connection->prepare("SELECT * FROM compte WHERE login= :login");/*Sécurité pour éviter les injections*/
    $res->bindParam(':login', $_POST['login'], PDO::PARAM_STR);
    $res->execute();
    $res->setFetchMode(PDO::FETCH_OBJ);
    $nbr1=$res->rowCount();

    if ($nbr1 != 0) /*Si le login existe dans la base de données*/
    {
        $t = $res->fetch();

        if (password_verify($mdp, $t->mdp))/*On vérifie que le mot de passe rentré est bon*/
        {
            $id_p = $t->id_personne;
            $req = $connection->query("SELECT nom, prenom FROM personne WHERE id_personne='$id_p'");
            $req->setFetchMode(PDO::FETCH_OBJ);
            $nbr2=$req->rowCount();
            if ($nbr2 != 0) 
            {
                $t = $req->fetch();

                $_SESSION['user'] = $user;
                $_SESSION['nom'] = $t->nom;
                $_SESSION['prenom'] = $t->prenom;
                $_SESSION['id'] = $id_p;
                /*Différents status proposés par le site*/
                if ($id_p[0] == 's') 
                {
                    $_SESSION['statut'] = "Professeur";
                }
                else if ($id_p[0] == 'a') 
                {
                    $_SESSION['statut'] = "Administrateur";
                }
                else if ($id_p[0] == 'p') 
                {
                    $_SESSION['statut'] = "Prez";
                }
                else if ($id_p[0] == 'x') 
                {
                    $_SESSION['statut'] = "God";  
                }
                else
                {
                    $_SESSION['statut'] = "Elève";  
                }
                $res->closeCursor();
                $req->closeCursor();
                return 0;
            }
        }
    }
    return -1;
}
?>

<!DOCTYPE html>
<html>
<?php

/*Retour de la fonction qui affiche un message indiquant la réussite ou non de la requète sous le champ d'entrée du mot de passe*/
if (auth($user,$mdp)==-1){
    echo '<form name="form" method="post" action="auth.php">';
    echo '<input type="hidden" name="ret" value=-1 />';
    echo '</form> <script type="text/javascript"> document.form.submit(); </script>';
}
else {
    echo '<form name="form" method="post" action="main_menu.php">';
    echo '<input type="hidden" name="ret" value=0 />';
    echo '</form> <script type="text/javascript"> document.form.submit(); </script>';
}

?>
</html>

