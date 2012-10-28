<?php
// TODO quitar los die, ponert status = 0
//~ debugMostrarCfg();
global $cfg;
//echo "\ncero=".$cfg['MAIN']['SERVIDOR'][0]." el uno =".$cfg['MAIN']['BBDD_name'][0]."\n";
$mysqli = new mysqli($cfg['MAIN']['SERVIDOR'][0], $bbdd_u, $bbdd_p, $cfg['MAIN']['BBDD_name'][0]);
$result = array();
$result["status"] = 1;
$result["data"] = "Conexion correcta a base de datos";

/*
 * Esta es la forma OO "oficial" de hacerlo,
 * AUNQUE $connect_error estaba averiado hasta PHP 5.2.9 y 5.3.0.
 */
if ($mysqli->connect_error) {
    die('Error de Conexión (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}

/*
 * Use esto en lugar de $connect_error si necesita asegurarse
 * de la compatibilidad con versiones de PHP anteriores a 5.2.9 y 5.3.0.
 */
if (mysqli_connect_error()) {
    die('Error de Conexión (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}
//~ echo 'Éxito... ' . $mysqli->host_info . "\n";
$mysqli->close();
return($result);
function ConexionBBDD(){
	return("simulacion de conexion");
}
?>
