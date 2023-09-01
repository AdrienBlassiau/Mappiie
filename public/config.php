<?php

/**
 * @file config.php
 * 
 * Ce fichier contient les éléments de connexion à la base de données
 *  
 */
 

require '../vendor/autoload.php';

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

?>