<?php
//TODO un quieroJson($distintoTipo);
# JSON
//~ $cfg['path_ok'] = "/home/dan/Dropbox/web_CRIKA/web";
//~ file:///home/dan/Dropbox/web_CRIKA/web/img/logo.jpg
// las funciones tb son globales
function array2json($array){
	$json =json_encode($array);
	return($json);
}

function json2array($json){
	return (json_decode($json));
}

###3 pruebas 
if(0){
//~ $json  = {"path_ok":"\/home\/dan\/Dropbox\/web_CRIKA\/web","bbdd":{"u":"root","p":"123qwe","h":"localhost","t":"werb_CRIKA"}}
$json  = '{"path_ok":"\/home\/dan\/Dropbox\/web_CRIKA\/web","bbdd":{"u":"root","p":"123qwe","h":"localhost","t":"werb_CRIKA"}}';
$array = array ();
$array["indexCERO"] = "posicion 1 array";
$array["indexUNO"] = "posicion 2 array";
//~ $array[0] = "posicion 1 array";  // OJO SIEMPRE PONER INDICES A LOS ARRAYS estas provocan que salga mal el json 
//~ $array[1] = "posicion 2 array";
$json2 = array2json($array);
$array2 = json2array($json);
	//~ var_dump($array);
}

?>
