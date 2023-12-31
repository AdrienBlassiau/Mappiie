
<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 24/04/18
 * Time: 15:31
 */

include("config.php");

$nom_hote = getenv("REMOTE_HOST");
function db_connect(){
    global $nom_hote, $dbUser, $dbName, $dbPassword;
    return pg_connect("host=$nom_hote user=$dbUser dbname=$dbName password=$dbPassword");
}

function db_query($db,$query){
	return pg_query( $db , $query  );
}

function db_transaction($db,$query_array){
    pg_query($db,"BEGIN");
    $res=1;
    foreach ($query_array as $req) {
        $res *= pg_query($db,$req);
    }
    if($res==0){
        pg_query($db,"ROLLBACK");
    }
    else{
        pg_query( $db , "COMMIT"  );
    }
}

function db_fetch($rep){
	return pg_fetch_assoc( $rep );
}


function db_count($rep){
	return pg_num_rows( $rep );
}


function db_close($db){
	return pg_close( $db );
}


?>
