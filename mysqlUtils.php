<?php

require 'mysqlcrud.php';
$BBDD = new Database();
$result_connect = $BBDD->connect();
//$values = array ("4334","rrr555");
//$status_insert = $BBDD->insert("EVENTOS",$values,"path_foto");
//var_dump($status_insert);
//die;
//echo $result_connect;
if($result_connect['status']){
	echo "conextionOK\n";
}
else{
	echo "error BBDD->conect() ".$result_connect['value']."\n";
}

function PruebaTrarmeDatosEventos(){  # move this to tests/mysqlcrud_p.php
	// Traerme Datos de EVENTOS. I could test how to detect Tables that have not got right name
	$BBDD->select("EVENTOS");
	$result_select = $BBDD->getResult();
	echo $result_select;
	var_dump($result_select);
}

// Isertar table, value, rows
function PruebaInsertarDatos(){			# move this to tests/mysqlcrud_p.php
	
	$values = array ("uno", "dos");
	$status_insert = $BBDD->insert("EVENTOS",$values,"path_foto");
	var_dump($status_insert);
	if($status_insert){
		echo "insert hecho\n";
	}
	else{
		echo "ERROR insert\n";
	}
}

$tt = PruebaInsertarDatos();
PruebaTrarmeDatosEventos();

// TODO: CREAR ESTOS
// Inserta en TABLA, $campos, $valores   InsertTableValuesFields($nomtable, $aValues, $aFields);
//  Returns $hResult


// DescribeTable: recieves name table Returns associative array
//($hdescribe['field']="type") = DescribeTable($nom_tabla);

// Create HTML 
// $html = CreateHtmlFromQuery





?>
