<?php
// Este scrpt es el remanente de mi mvc propio 
# VARIABLES GLOBALES
$cfg['path_ok'] = "/home/dan/Dropbox/web_CRIKA/web";

// TODO securizar esto
$bbdd_u = "root";
$bbdd_p = "123qwe";
# VARIALES CFG
$probar = 1;
$nom_webcfg ="web.cfg";
$path_webcfg = $cfg['path_ok']."/cfg/".$nom_webcfg;
$nom_main_cfg ="main.cfg";
$path_cfgs = $cfg['path_ok']."/cfg/";
//~ print_r("[[[".$path_webcfg."]]]");

//~ $handle = $fh;

//TODO
//~ CargarNivelCFG("WEB",$path_webcfg);
CargarNivelCFG("WEB",$path_cfgs."/web.cfg");
CargarNivelCFG("MAIN",$path_cfgs."/main.cfg");

//~ Function CargarNivelCFG 
//~ Carga en global cfg el contenido del cfg (fichero del segundo parametro)
//~ Parameters 
	//~ Nivel  - es el key del CFG
	//~ path al cfg
function CargarNivelCFG($nivel, $path_fh){
	global $cfg;
	$fh = fopen($path_fh, 'r');
	if ($fh) {
		$actual_key = "";
		//~ $nivel =  "WEB";
		while (($buffer = fgets($fh, 4096)) !== false) {
			$buffer = trim($buffer); # quitar enter y lineas vacias por lo exteremmos
			if ($buffer != "") { # not empty line
					if (preg_match("!^//.+$!", $buffer)) { # starts with // 
						$actual_key = $buffer;
						$actual_key = preg_replace("!//!","",$actual_key);
					}
					else{
						$all_values = preg_split("/ /",$buffer);
						$cfg[$nivel][$actual_key]=$all_values;
					}
				}
			}
		}
		if (!feof($fh)) {
			echo "Error: unexpected fgets() fail\n";
		}
		 fclose($fh);
}
//~ debugMostrarCfg($cfg);
// las funciones tb son globales
function EscribirHTML($html){
	print_r($html);
}
# TODO PARSING FUNCTIONS
?>
