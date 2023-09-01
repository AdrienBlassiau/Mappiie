<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 24/04/18
 * Time: 15:31
 */

include("config.php");



function ajout_ue($id_ue,$id_module,$description)
{
    if($db=db_connect())
    {
        $req="INSERT INTO ue VALUES (".test_input($id_ue).",".test_input($id_module).",".test_input($description).")";
        if($rep=db_query($db,$req))
        {
            db_close($db);
            return array(0);
        }
        else
        {
            db_close($db);
            return array(-2);
        }
    }
    else
    {
        return array(-3);
    }
}
function ajout_intervention($date_inter,$professeur,$id_sem,$id_module)
{
    if($db=db_connect())
    {
        $req="INSERT INTO intervention VALUES (".test_input($date_inter).",".test_input($professeur).",".test_input($id_sem).",".test_input($id_module).")";
        if($rep=db_query($db,$req))
        {
            db_close($db);
            return array(0);
        }
        else
        {
            db_close($db);
            return array(-2);
        }
    }
    else
    {
        return array(-3);
    }
}
function ajout_module($id_module,$libelle)
{
    if($db=db_connect())
    {
        $req="INSERT INTO modules VALUES (".test_input($id_module).",".test_input($libelle).")";
        if($rep=db_query($db,$req))
        {
            db_close($db);
            return array(0);
        }
        else
        {
            db_close($db);
            return array(-2);
        }
    }
    else
    {
        return array(-3);
    }
}
function ajout_semestre($id_sem)
{
    if($db=db_connect())
    {
        $req="INSERT INTO semestre VALUES (".test_input($id_sem).")";
        if($rep=db_query($db,$req))
        {
            db_close($db);
            return array(0);
        }
        else
        {
            db_close($db);
            return array(-2);
        }
    }
    else
    {
        return array(-3);
    }
}
function ajout_professeur($id_personne)
{
    if($db=db_connect())
    {
        $req="INSERT INTO professeur VALUES (".test_input($id_personne).")";
        if($rep=db_query($db,$req))
        {
            db_close($db);
            return array(0);
        }
        else
        {
            db_close($db);
            return array(-2);
        }
    }
    else
    {
        return array(-3);
    }
}
function ajout_eleve($id_personne,$pseudo)
{
    if($db=db_connect())
    {
        $req="INSERT INTO eleve VALUES (".test_input($id_personne).",".test_input($pseudo).")";
        if($rep=db_query($db,$req))
        {
            db_close($db);
            return array(0);
        }
        else
        {
            db_close($db);
            return array(-2);
        }
    }
    else
    {
        return array(-3);
    }
}
function ajout_personne($id_personne,$pseudo)
{
    if($db=db_connect())
    {
        $req="INSERT INTO personne VALUES (".test_input($id_personne).",".test_input($pseudo).")";
        if($rep=db_query($db,$req))
        {
            db_close($db);
            return array(0);
        }
        else
        {
            db_close($db);
            return array(-2);
        }
    }
    else
    {
        return array(-3);
    }
}
function ajout_compte($id_compte,$id_personne)
{
    if($db=db_connect())
    {
        $req="INSERT INTO compte VALUES (".test_input($id_compte).",".test_input($id_personne).")";
        if($rep=db_query($db,$req))
        {
            db_close($db);
            return array(0);
        }
        else
        {
            db_close($db);
            return array(-2);
        }
    }
    else
    {
        return array(-3);
    }
}
function ajout_association($nom_assoc,$id_eleve,$id_prez,$id_salle)
{
    if($db=db_connect())
    {
        $req="INSERT INTO association VALUES (".test_input($nom_assoc).",".test_input($id_eleve).",".test_input($id_prez).",".test_input($id_salle).")";
        if($rep=db_query($db,$req))
        {
            db_close($db);
            return array(0);
        }
        else
        {
            db_close($db);
            return array(-2);
        }
    }
    else
    {
        return array(-3);
    }
}
function ajout_preference($id_pref,$id_carac)
{
    if($db=db_connect())
    {
        $req="INSERT INTO preference VALUES (".test_input($id_pref).",".test_input($id_carac).")";
        if($rep=db_query($db,$req))
        {
            db_close($db);
            return array(0);
        }
        else
        {
            db_close($db);
            return array(-2);
        }
    }
    else
    {
        return array(-3);
    }
}
function ajout_caracteristiques($id_carac,$luminosite,$nb_fenetres,$nb_places,$proprete)
{
    if($db=db_connect())
    {
        $req="INSERT INTO caracteristiques VALUES (".test_input($id_carac).",".test_input($luminosite).",".test_input($nb_fenetres).",".test_input($nb_places).",".test_input($proprete).")";
        if($rep=db_query($db,$req))
        {
            db_close($db);
            return array(0);
        }
        else
        {
            db_close($db);
            return array(-2);
        }
    }
    else
    {
        return array(-3);
    }
}

function ajout_tableau($type_tab,$type_ecriture,$id_carac)
{
    if($db=db_connect())
    {
        $req="INSERT INTO tableau VALUES (".test_input($type_tab).",".test_input($type_ecriture).",".test_input($id_carac).")";
        if($rep=db_query($db,$req))
        {
            db_close($db);
            return array(0);
        }
        else
        {
            db_close($db);
            return array(-2);
        }
    }
    else
    {
        return array(-3);
    }
}

function ajout_note($date_note,$id_personne,$id_salle)
{
    if($db=db_connect())
    {
        $req="INSERT INTO note VALUES (".test_input($date_note).",".test_input($id_personne).",".test_input($id_salle).")";
        if($rep=db_query($db,$req))
        {
            db_close($db);
            return array(0);
        }
        else
        {
            db_close($db);
            return array(-2);
        }
    }
    else
    {
        return array(-3);
    }
}

function ajout_reservation($date_res,$id_personne,$id_salle)
{
    if($db=db_connect())
    {
        $req="INSERT INTO reservation VALUES (".test_input($date_res).",".test_input($id_personne).",".test_input($id_salle).")";
        if($rep=db_query($db,$req))
        {
            db_close($db);
            return array(0);
        }
        else
        {
            db_close($db);
            return array(-2);
        }
    }
    else
    {
        return array(-3);
    }
}

function ajout_chemin($date_chem,$id_personne,$id_salle)
{
    if($db=db_connect())
    {
        $req="INSERT INTO chemin VALUES (".test_input($date_chem).",".test_input($id_personne).",".test_input($id_salle).")";
        if($rep=db_query($db,$req))
        {
            db_close($db);
            return array(0);
        }
        else
        {
            db_close($db);
            return array(-2);
        }
    }
    else
    {
        return array(-3);
    }
}

function ajout_salle($id_salle,$num_etage,$id_carac)
{
    if($db=db_connect())
    {
        $req="INSERT INTO chemin VALUES (".test_input($id_salle).",".test_input($num_etage).",".test_input($id_carac).")";
        if($rep=db_query($db,$req))
        {
            db_close($db);
            return array(0);
        }
        else
        {
            db_close($db);
            return array(-2);
        }
    }
    else
    {
        return array(-3);
    }
}

function ajout_etage($num_etage)
{
    if($db=db_connect())
    {
        $req="INSERT INTO etage VALUES (".test_input($num_etage).")";
        if($rep=db_query($db,$req))
        {
            db_close($db);
            return array(0);
        }
        else
        {
            db_close($db);
            return array(-2);
        }
    }
    else
    {
        return array(-3);
    }
}

function get_ue_du_module($id_module)
{
    if($db=db_connect())
        {
            $req="SELECT id_ue FROM ue WHERE id_module=".test_input($id_module)."";
            if($rep=db_query($db,$req))
                {
                    db_close($db);
                    if (db_count($rep))
                        {
                            $p=db_fetch($rep);
                            $t=array(0,$p['id_ue']);
                            return $t;
                        }
                    else
                        {
                            return array(-1,0);
                        }
                }
            else
                {
                    db_close($db);
                    return array(-2,0);
                }
        }
    else
        {
            return array(-3,0);
        }
}

function get_modules_du_ue($id_ue)
{
    if($db=db_connect())
    {
        $req="SELECT id_modele,libelle FROM ue NATURAL JOIN modules WHERE id_ue=".test_input($id_ue)."";
        if($rep=db_query($db,$req))
        {
            db_close($db);
            if (db_count($rep))
            {
                $p=db_fetch($rep);
                $t=array(0,$p['id_modele'],$p['libelle']);
                return $t;
            }
            else
            {
                return array(-1,0,0);
            }
        }
        else
        {
            db_close($db);
            return array(-2,0,0);
        }
    }
    else
    {
        return array(-3,0,0);
    }
}

function get_intervention($date_inter,$professeur,$id_sem,$id_module)
{
    if($db=db_connect())
    {
        $req="SELECT date_inter,professeur,id_sem,id_module FROM intervention";
        if ($date_inter!=NULL || $professeur!=NULL || $id_sem!=NULL || $id_module!=NULL ){ $req.="WHERE";}
        $b=false;
        $req.=($date_inter!=NULL) ? "date_inter=".test_input($date_inter)."": "";
        if ($date_inter){$b=true;}
        $req.=($professeur!=NULL && $b) ? "AND": "";
        $req.=($professeur!=NULL) ? "professeur=".test_input($professeur)."": "";
        if ($professeur){$b=true;}
        $req.=($id_sem!=NULL && $b) ? "AND": "";
        $req.=($id_sem!=NULL) ? "id_sem=".test_input($id_sem)."": "";
        if ($id_sem){$b=true;}
        $req.=($id_module!=NULL && $b) ? "AND": "";
        $req.=($id_module!=NULL) ? "id_module=".test_input($id_module)."": "";

        if($rep=db_query($db,$req))
        {
            db_close($db);
            if (db_count($rep))
            {
                $p=db_fetch($rep);
                $t=array($p['date_inter'],$p['professeur'],$p['id_sem'],$p['id_module']);
                return array(0,$t);
            }
            else
            {
                return array(-1,array());
            }
        }
        else
        {
            db_close($db);
            return array(-2,array());
        }
    }
    else
    {
        return array(-3,array());
    }
}

function get_personne($id_personne,$nom,$prenom,$id_pref)
{
    if($db=db_connect())
    {
        $req="SELECT id_personne,nom,prenom,id_pref FROM intervention";
        if ($id_personne!=NULL || $nom!=NULL || $prenom!=NULL || $id_pref!=NULL ){ $req.="WHERE";}
        $b=false;
        $req.=($id_personne!=NULL) ? "id_personne=".test_input($id_personne)."": "";
        if ($id_personne){$b=true;}
        $req.=($nom!=NULL && $b) ? "AND": "";
        $req.=($nom!=NULL) ? "nom=".test_input($nom)."": "";
        if ($nom){$b=true;}
        $req.=($prenom!=NULL && $b) ? "AND": "";
        $req.=($prenom!=NULL) ? "prenom=".test_input($prenom)."": "";
        if ($prenom){$b=true;}
        $req.=($id_pref!=NULL && $b) ? "AND": "";
        $req.=($id_pref!=NULL) ? "id_pref=".test_input($id_pref)."": "";

        if($rep=db_query($db,$req))
        {
            db_close($db);
            if (db_count($rep))
            {
                $p=db_fetch($rep);
                $t=array($p['id_personne'],$p['nom'],$p['prenom'],$p['id_pref']);
                return array(0,$t);
            }
            else
            {
                return array(-1,array());
            }
        }
        else
        {
            db_close($db);
            return array(-2,array());
        }
    }
    else
    {
        return array(-3,array());
    }
}

function get_salle($id_salle,$num_etage,$id_carac,$luminosite,$nb_fenetres,$acceshand,$nb_places,$proprete)
{
    if($db=db_connect())
    {
        $req="SELECT id_salle,num_etage,id_carac,luminosite,nb_fenetres,acceshand,nb_places,proprete FROM salle NATURAL JOIN caracteristiques";
        if ($id_salle!=NULL || $num_etage!=NULL || $id_carac!=NULL || $luminosite!=NULL || $nb_fenetres!=NULL || $acceshand!=NULL || $nb_places!=NULL || $proprete!=NULL){ $req.="WHERE";}
        $b=false;
        $req.=($id_salle!=NULL) ? "id_salle=".test_input($id_salle)."": "";
        if ($id_salle){$b=true;}
        $req.=($num_etage!=NULL && $b) ? "AND": "";
        $req.=($num_etage!=NULL) ? "num_etage=".test_input($num_etage)."": "";
        if ($num_etage){$b=true;}
        $req.=($id_carac!=NULL && $b) ? "AND": "";
        $req.=($id_carac!=NULL) ? "id_carac=".test_input($id_carac)."": "";
        if ($id_carac){$b=true;}
        $req.=($luminosite!=NULL && $b) ? "AND": "";
        $req.=($luminosite!=NULL) ? "luminosite=".test_input($luminosite)."": "";
        if ($luminosite){$b=true;}
        $req.=($nb_fenetres!=NULL && $b) ? "AND": "";
        $req.=($nb_fenetres!=NULL) ? "nb_fenetres=".test_input($nb_fenetres)."": "";
        if ($nb_fenetres){$b=true;}
        $req.=($acceshand!=NULL && $b) ? "AND": "";
        $req.=($acceshand!=NULL) ? "acceshand=".test_input($acceshand)."": "";
        if ($acceshand){$b=true;}
        $req.=($nb_places!=NULL && $b) ? "AND": "";
        $req.=($nb_places!=NULL) ? "nb_places=".test_input($nb_places)."": "";
        if ($nb_places){$b=true;}
        $req.=($proprete!=NULL && $b) ? "AND": "";
        $req.=($proprete!=NULL) ? "proprete=".test_input($proprete)."": "";

        if($rep=db_query($db,$req))
        {
            db_close($db);
            if (db_count($rep))
            {
                $p=db_fetch($rep);
                $t=array($p['id_salle'],$p['num_etage'],$p['id_carac'],$p['luminosite'],$p['nb_fenetres'],$p['acceshand'],$p['nb_places'],$p['proprete']);
                return array(0,$t);
            }
            else
            {
                return array(-1,array());
            }
        }
        else
        {
            db_close($db);
            return array(-2,array());
        }
    }
    else
    {
        return array(-3,array());
    }
}

function get_chemin($date_chem,$id_personne,$id_salle)
{
    if($db=db_connect())
    {
        $req="SELECT date_chem,id_personne,id_salle FROM chemin ";
        if ($date_chem!=NULL || $id_personne!=NULL || $id_salle!=NULL ){ $req.="WHERE";}
        $b=false;
        $req.=($date_chem!=NULL) ? "date_chem=".test_input($date_chem)."": "";
        if ($date_chem){$b=true;}
        $req.=($id_personne!=NULL && $b) ? "AND": "";
        $req.=($id_personne!=NULL) ? "id_personne=".test_input($id_personne)."": "";
        if ($id_personne){$b=true;}
        $req.=($id_salle!=NULL && $b) ? "AND": "";
        $req.=($id_salle!=NULL) ? "id_salle=".test_input($id_salle)."": "";

        if($rep=db_query($db,$req))
        {
            db_close($db);
            if (db_count($rep))
            {
                $p=db_fetch($rep);
                $t=array($p['id_salle'],$p['num_etage'],$p['id_carac'],$p['luminosite'],$p['nb_fenetres'],$p['acceshand'],$p['nb_places'],$p['proprete']);
                return array(0,$t);
            }
            else
            {
                return array(-1,array());
            }
        }
        else
        {
            db_close($db);
            return array(-2,array());
        }
    }
    else
    {
        return array(-3,array());
    }
}


/*affiche toutes les salles réservées par le client*/
function get_reservation_client($id_personne)
{
    if($db=db_connect())
        {
            $req="SELECT date_res,id_salle FROM reservation WHERE id_personne=".test_input($id_personne)."";
            if($rep=db_query($db,$req))
                {
                    db_close($db);
                    if (db_count($rep))
                        {
                            $t=array();
                            while ($personne=db_fetch($rep)) 
                            {
                                $t[]=array($personne['id_res'],$personne['id_salle']);
                            }

                            return array(0,$t);
                        }
                    else
                        {
                            return array(-1,array());
                        }
                }
            else
                {
                    db_close($db);
                    return array(-2,array());
                }
        }
    else
        {
            return array(-3,array());
        }
}
/*affiche les infos de la salle*/
function get_infos_salle($id_salle)
{
    if($db=db_connect())
        {
            $req="SELECT num_etage,luminosite,nb_fenetres,acceshand,nb_places,proprete FROM salle NATURAL JOIN caracteristiques WHERE id_salle=".test_input($id_salle)."" ;
            if($rep=db_query($db,$req))
                {
                    db_close($db);
                    if (db_count($rep))
                        {
                            while($salle=db_fetch($rep))
                            {
                            $t[]=array($salle['num_etage'],$salle['luminosite'],$salle['nb_fenetres'],$salle['acceshand'],$salle['nb_places'],$salle['proprete']);
                            }
                            return array(0,$t);
                        }
                    else
                        {
                            return array(-1,array());
                        }
                }
            else
                {
                    db_close($db);
                    return array(-2,array());
                }
        }
    else
        {
            return array(-3,array());
        }
}



/*affiche toutes les salles dispos à la date demandée*/
function get_salles_dispo($dates)
{
    if($db=db_connect())
        {
            $req="SELECT id_salle FROM salle WHERE id_salle NOT IN ( SELECT id_ salle FROM reservation WHERE date_res=".test_input($dates).")" ;
            if($rep=db_query($db,$req))
                {
                    db_close($db);
                    if (db_count($rep))
                        {
                            while($salle=db_fetch($rep))
                            {
                            $t[]=array($salle['id_salle']);
                            }
                            return array(0,$t);
                        }
                    else
                        {
                            return array(-1,array());
                        }
                }
            else
                {
                    db_close($db);
                    return array(-2,array());
                }
        }
    else
        {
            return array(-3,array());
        }
}
/*affiche 0 si la salle est dispo à la date demandée sinon -1  */
function get_salle_est_dispo($id_salle,$dates)
{
    if($db=db_connect())
        {
            $req="SELECT id_salle FROM salle NATURAL JOIN reservation WHERE date_res=".test_input($dates)." AND id_salle=".test_input($id_salle)."" ;
            if($rep=db_query($db,$req))
                {
                    db_close($db);
                    if (db_count($rep))
                        {
                            return array(-1);
                        }
                    else
                        {
                            return array(0);
                        }
                }
            else
                {
                    db_close($db);
                    return array(-2);
                }
        }
    else
        {
            return array(-3);
        }

}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>



