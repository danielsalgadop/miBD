<?php
require 'miDB.php';
$BBDD  = new Database();
$result_connect = $BBDD->connect();
if($result_connect['status'] == 0){ // asegurarme que respeta convencion de miDB.php explicada en cabecera con respecto a errores
	print_r($result_connect['value']);
}

$r_showtables = $BBDD->showTables();
if($r_showtables['status'] == 1){  // asegurarme que respeta convencion de miDB.php explicada en cabecera con respecto a errores
	print_r($r_showtables['avalues']);
}

$tabla = "ARTISTAS";
$r_tableExists = $BBDD->tableExists($tabla);
if($r_tableExists['status']){
	print_r($r_tableExists['status']);
}


$r_select = $BBDD->select($tabla);
print_r($r_select['avalues']);


//~ var_dump($r_showtables);

//~ $dbOBJ->connect();
//~ exit($dbOBJ);
//~ exit;
//~ $dbOBJ->connect();
 //~ $dbOBJ2  = new Database();
//~ $dbOBJ2->connect();



//~ print_r("se ha ejecutado bien\n");
?>
