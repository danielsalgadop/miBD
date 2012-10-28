<?php
//TODO
//
//
//~ var $debugD = "1";
$contador = 0;
function debugMostrarCfg(){
	global $contador;
	$contador = $contador + 1;
	global $cfg;
	//~ print "entras";
	//~ if ($debugD == "1"){
		echo "toe";
	//~ system('ls'
	$json = json_encode($cfg);
	$eo = "JSON<pre>".$json."</pre>";
	$eo .= "<h3>NIVEL1</h3>";
	foreach ($cfg as $key => $item){
		$eo .= "<h4>".$key."</h4>";
	}
	$eo = "<html>".$eo."</html>";
	system ( "rm /tmp/debug*");
	system ( "rm /tmp/totaldebug*");
	system ("echo '".$eo."' > /tmp/debug".$contador.".html");
	system ("echo '".$eo."' > /tmp/totaldebug.html");
	//~ }
}
$result['status'] =1;
return($result);


?>
