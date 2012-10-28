<?php

//$cfg['path_ok'] = "/home/dan/Dropbox/web_CRIKA/web";
//$probar = 1;
//$nom_webcfg ="web.cfg";
//$path_webcfg = $cfg['path_ok']."/cfg/".$nom_webcfg;
//$nom_main_cfg ="main.cfg";
//$path_cfgs = $cfg['path_ok']."/cfg/";
//~ print_r("[[[".$path_webcfg."]]]");


//~ $handle = $fh;

//TODO
//~ CargarNivelCFG("WEB",$path_webcfg);
//~ debugMostrarCfg($cfg);

# TODO PARSING FUNCTIONS
//echo "\ncero=".$cfg['MAIN']['SERVIDOR'][0]." el uno =".$cfg['MAIN']['BBDD_name'][0]."\n";

//var_dump($cfg);
//var_dump($GLOBALS);
class myDBH {
	//global $cfg;
	 //print_r("SERVIDOR[[".$cfg['MAIN']['SERVIDOR'][0]."]]\n");
  protected $db_info = array("host" => "localhost", "dbname" => "myDB", "username" => "myDB_user", "password" => "myDB_password");
  //echo "\ncero=".$cfg['MAIN']['SERVIDOR'][0]." el uno =".$cfg['MAIN']['BBDD_name'][0]."\n";
  //echo $cfg['MAIN']['SERVIDOR'][0]."\n";
  //print_r("chuccrut\n");
	//return(1);
  //protected $db_info = array ("host" => $cfg['MAIN']['SERVIDOR'][0], "myDB_user" => $bbdd_u, "password" =>$bbdd_p, "dbname" =>$cfg['MAIN']['BBDD_name'][0]);
  public $dbh;

  public function __construct() {
    $this->dbh = new PDO("mysql:host={$this->db_info['host']};dbname={$this->db_info['db_name']}", $this->db_info['username'], $this->db_info['password'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
    $this->dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  }

  public function fetch_rows($sql) {
    $rst = $this->dbh->query($sql);
    return $rst->fetchAll();
  }

  public function fetch_row($sql) {
    $rst = $this->dbh->query($sql);
    return $rst->fetch();
  }
}



//http://phpsenior.blogspot.com.es/2005/09/patrn-de-diseo-singleton.html
class BBDD { // Singleton
    static private $instancia = NULL;

   private function __construct() {
		return "DEVOLVER CONEXION a bbdd ";
		//$mysqli = new mysqli($cfg['MAIN']['SERVIDOR'][0], $bbdd_u, $bbdd_p, $cfg['MAIN']['BBDD_name'][0]);

	   }

    static public function getInstancia() {
       if (self::$instancia == NULL) {
          self::$instancia = new BBDD ();
       }
       return self::$instancia;
    }
    //public function getDatoTabla() {}
    //public function getTodosDatosTabla() {}
    //public function getDescribeTabla() {}
    //public function getTodosDatosTablaRaw() {}
    //public function getDescribeTablaRaw() {}
}



class Usuario{
	// ATRIBUTOS
	private $nombreDeUsuario;
	private $palabraClave;
	// CONSTRUCTOR DE LA CLASE
	public function Usuario() { }
	// FUNCIONES CONSULTORAS
	public function getNombreDeUsuario() { return $this->nombreDeUsuario; }
	public function getPalabraClave() { return $this->palabraClave; }
	// FUNCIONES MODIFICADORAS
	public function setNombreDeUsuario($nu) { $this->nombreDeUsuario = $nu; }
	public function setPalabraClave($pc) { $this->palabraClave = $pc; }
	public function miDumper(){
		echo "nombreDeUsuario=[".$this->nombreDeUsuario."]\n";
		echo "palabraClave=[".$this->palabraClave."]\n";
	}
}



class UsuarioSingleton { // Singleton
    static private $instancia = NULL;

   //private function __construct() {
	   //echo "\n no pasas por aqui\n";
	   //$usuario = new Usuario();
		//return $usuario;
	   //}
    static public function getInstancia() {
       if (self::$instancia == NULL) {
          $usuario = new Usuario();
          self::$instancia = $usuario;
       }
       //return ("instancia" = >self::$instancia, "ObjUsuarioSinleton" => $usuario);
       return (self::$instancia);
    }
}



?>
