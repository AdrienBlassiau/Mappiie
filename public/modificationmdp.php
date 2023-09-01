<?php
/**
 * @file modificationmdp.php
 * 
 * Ce fichier contient la fonction de modification de mot de passe proposé à un utilisateur connecté
 * Il contient 1 fonction.
 * 
 * - newmdp($mdp1,$mdp2,$mdp)                       
 * 
 */
session_start();
include "config.php";

/**
 * fonction qui met à jour le mot de passe de l'utilisateur
 * @param   $mdp1 le nouveau mot de passe de l'utilisateur
 * @param   $mdp2 la confirmation du nouveau mot de passe de l'utilisateur
 * @param   $mdp  le mot de passe courant de l'utilisateur
 * @return        0 si succès, autre chose si echec
 */
function newmdp($mdp1,$mdp2,$mdp)
{
    global $connection;
    $current_user = $_SESSION['user'];
    $res=$connection->query("SELECT * FROM compte WHERE login='$current_user'");
    $res->setFetchMode(PDO::FETCH_OBJ);
    $nbr1=$res->rowCount();

    if ($nbr1 != 0)/*Si l'utilisateur existe dans la base de données*/
    {
        $t = $res->fetch();
        if (password_verify($mdp, $t->mdp)) /*Si son mot de passe courant est bon*/
        {
            $res->closeCursor();
            if ($mdp1 == $mdp2)/*Si ses deux nouveaux mots de passes coincident*/
            {
                if (strlen($mdp1)>=6)/*Si ils ont une taille >= à 6*/
                {
                    $mdp = $_POST['mdp1'];
                    $mdp_hash = password_hash($mdp ,PASSWORD_DEFAULT);            
                    $connection->exec("UPDATE compte SET mdp = '$mdp_hash' WHERE login = '$current_user'");

                    return 0;  /*Succès !*/   
                }
                else
                {
                    return -1;
                }

            }

            else
            {
              return -2;  
          }
      }
      else
      {
        $res->closeCursor();
        return -3;  
    }
}
else
{
    return -4;  
}
}

?>

<!DOCTYPE html>
<html>
<?php
$mdp = $_POST['mdp'];
$mdp1 = $_POST['mdp1'];
$mdp2 = $_POST['mdp2'];
$ret = newmdp($mdp1,$mdp2,$mdp);

/*Retourne la valeur de retour de la fonction indiquant le succès ou l’échec de la création de mot de passe*/
echo '<head> </head>';
echo '<body>';
echo '<form name="form" method="post" action="changermdp.php">';
echo '<input type="hidden" name="ret2" value='.$ret.' />';
echo '</form> <script type="text/javascript"> document.form.submit(); </script>';
echo '</body>';

create_footer();

?>
</html>

