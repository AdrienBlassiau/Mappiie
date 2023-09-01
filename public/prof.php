<?php
/**
 * @file prof.php
 * 
 * Ce fichier contient l'ensemble de fonctions qui récupèrent les données sur les cours à afficher dans le formulaire de création de cours.
 * Il contient 3 fonctions.
 *
 * - listeprof()
 * - listemodule()
 * - listegroupe()
 * 
 */
include "config.php";


/**
 * fonction qui renvoie la liste des professeurs de première année
 * @return la liste des professeurs de 1A
 */
function listeprof()
{
	global $connection;
	$res=$connection->query("SELECT * FROM professeur LEFT OUTER JOIN personne ON professeur.id_professeur = personne.id_personne");
	$res->setFetchMode(PDO::FETCH_OBJ);
	return $res;
}

/**
 * fonction qui renvoie la liste des modules de première année
 * @return la liste des modules de 1A
 */
function listemodule()
{
	global $connection;
	$res=$connection->query("SELECT * FROM module");
	$res->setFetchMode(PDO::FETCH_OBJ);
	return $res;
}

/**
 * fonction qui renvoie la liste des groupes 
 * @return la liste des groupes
 */
function listegroupe()
{
	global $connection;
	$res=$connection->query("SELECT * FROM groupe");
	$res->setFetchMode(PDO::FETCH_OBJ);
	return $res;
}

?>