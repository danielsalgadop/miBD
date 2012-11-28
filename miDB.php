<?php
/*
 * Using  mysqli
 * Description: Contains database connection, result
 *              Management functions, input validation
 *
 *              All functions return true if completed
 *              successfully and false if an error
 *              occurred
 *
 *  En return['status'] == 0 es OK
 *  En return['status'] != "Descripcion del error";
 * 
 */
class Database
{

    /*
     * Edit the following variables
     */
    private $db_host = 'localhost';     // Database Host
    private $db_user = 'root';          // Username
    private $db_pass = '123qwe';          // Password
    private $db_name = 'web_CRIKA';          // Database
    /*
     * End edit
     */

    private $con = false;               // Checks to see if the connection is active
    private $result = array();          // Results that are returned from the query

    /*
     * Connects to the database, only one connection
     * allowed
     */
    public function connect()
    {
		$return['status'] = 0;
		$return['value'] = "";
        if(!$this->con)
        {
            $myconn = new mysqli($this->db_host,$this->db_user,$this->db_pass,$this->db_name);
            //~ Antes tenia aqui codigo para ver los errores, ahora mysqli lo hace solo
            if(mysqli_connect_errno()) {
				echo "Error: Could not connect to database.\n";
				exit;
			}
			else{
					$this->con = $myconn;
			}
        }
        else
        {
				//~ habria que return(this->con)   ¿no?
			  	$return['status'] = 0;
				$return['value'] = "Ya existe una conexion";
                //return false;
                return ($return);
        }
    }

    /*
    * Changes the new database, sets all current results
    * to null
    */
    public function setDatabase($name)
    {
        if($this->con)
        {
            if(mysql_close())
            {
                $this->con = false;
                $this->results = null;
                $this->db_name = $name;
                $this->connect();
            }
        }

    }

    /*
    * show tables in the database
    * 
    */
    public function showTables()
    {
		$return['status'] = 0;
		$return['avalues'] = array();
		
        $tablesShown = $this->con->query('SHOW TABLES FROM '.$this->db_name);
        $numTablesShown = $tablesShown->num_rows;
        if($numTablesShown) {
			$avalues = array();
			while ( $row = $tablesShown->fetch_assoc() ){
					$avalues[] = $row['Tables_in_'.$this->db_name];  // el key del array rows es asi Tables_in_web_CRIKA
			}
			$return['avalues'] = $avalues;
			// se supone que deberia hacer $this->result= $retrun['avalues]; y posteriormente usar getResult
			return($return);
        }
    }
    /*
    * Checks to see if the table exists when performing
    * queries
    * tengo que ponerla public para hacer las pruebas, pero puedes ser private
    */
    public function tableExists($table)
    {
		// TODO  pensar usar solo return true y return false
		$return['status'] = 0;  //status OK
		$return['bool'] = true;  //status OK
		
        $tableExists =  $this->con->query('SHOW TABLES FROM '.$this->db_name.' LIKE "'.$table.'"');  // TODO probar tabla eo y eox ver si las diferencia
        $numTableExists = $tableExists->num_rows;
        if (!$numTableExists){
			$return['status'] = "Esta tabla no existe ".$table;
			$return['bool'] = false;
		}
		return($return);
    }

    /*
    * Selects information from the database.
    * Required: table (the name of the table)
    * Optional: rows (the columns requested, separated by commas)
    *           where (column = value as a string)
    *           order (column DIRECTION as a string)
    * Return: array of values
    */
    public function select($table, $rows = '*', $where = null, $order = null)
    {
		// TODO meterle limit
		$return['status'] = 0;
		$return['avalues'] = array();
		// TODO meter aqui el tableExists
		$avalues = array();
        $q = 'SELECT '.$rows.' FROM '.$table;
        if($where != null)
            $q .= ' WHERE '.$where;
        if($order != null)
            $q .= ' ORDER BY '.$order;

        $query = $this->con->query($q);
        while( $resultado = $query->fetch_assoc()) {
                    //~ for($i = 0; $i < $numResults; $i++)
            $datos_un_registro	= array();
			foreach ($resultado as $col_name => $valor){
				if($col_name == "id"){   // el id es el key de avalues, no lo guardo en datos_un_registro por no guardarlo duplicado
					continue;
				}
				$datos_un_registro[$col_name]= $valor;
			}
			$avalues[$resultado['id']] = $datos_un_registro;
		}
		$return['avalues'] = $avalues;
		// se supone que deberia hacer $this->result= $retrun['avalues]; y posteriormente usar getResult
		return($return);
    }

	/*
	 * Describe la tabla y el tipo de dato
	 */
	public function describe($table){
		$return['status'] = 0;
		$return['avalues'] = array();
		// TODO meter aqui el tableExists
		$q = 'DESCRIBE '.$table;
		$query = $this->con->query($q);
			$avalues = array();
		while( $resultado = $query->fetch_assoc()) {
			$nom_field =  $resultado['Field'];  // Copio el valor de Field (que da nombre a la columna)
			unset($resultado['Field']);   // Borro este campo para no tener duplicada la informacion
			$avalues[$nom_field] = $resultado; //array($parametro_nombre => $parametro_valor);
		}
		$return['avalues'] = $avalues;
		// se supone que deberia hacer $this->result= $retrun['avalues]; y posteriormente usar getResult // nada me ipide hacer ambas
		return($return);
	}


    /*
     * TODO pasarlo a mysqli
    * Insert values into the table
    * Required: table (the name of the table)
    *           values (the values to be inserted) ARRAY
    * Optional: rows (if values don't match the number of rows)
    */
    public function insert($table,$values,$rows = null)
    {
		$result['status']="";
        if($this->tableExists($table))
        {
            $insert = 'INSERT INTO '.$table;
            if($rows != null)
            {
                $insert .= ' ('.$rows.')';
            }

            for($i = 0; $i < count($values); $i++)
            {
                if(is_string($values[$i]))
                    $values[$i] = '"'.$values[$i].'"';
            }
            $values = implode(',',$values);
            $insert .= ' VALUES ('.$values.')';

            $ins = @mysql_query($insert);

            if($ins)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }

    /*
    * Deletes table or records where condition is true
    * Required: table (the name of the table)
    * Optional: where (condition [column =  value])
    */
    public function delete($table,$where = null)
    {
        if($this->tableExists($table))
        {
            if($where == null)
            {
                $delete = 'DELETE '.$table;
            }
            else
            {
                $delete = 'DELETE FROM '.$table.' WHERE '.$where;
            }
            $del = @mysql_query($delete);

            if($del)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    /*
     * Updates the database with the values sent
     * Required: table (the name of the table to be updated
     *           rows (the rows/values in a key/value array
     *           where (the row/condition in an array (row,condition) )
     */
    public function update($table,$rows,$where)
    {
        if($this->tableExists($table))
        {
            // Parse the where values
            // even values (including 0) contain the where rows
            // odd values contain the clauses for the row
            for($i = 0; $i < count($where); $i++)
            {
                if($i%2 != 0)
                {
                    if(is_string($where[$i]))
                    {
                        if(($i+1) != null)
                            $where[$i] = '"'.$where[$i].'" AND ';
                        else
                            $where[$i] = '"'.$where[$i].'"';
                    }
                }
            }
            $where = implode('',$where);


            $update = 'UPDATE '.$table.' SET ';
            $keys = array_keys($rows);
            for($i = 0; $i < count($rows); $i++)
            {
                if(is_string($rows[$keys[$i]]))
                {
                    $update .= $keys[$i].'="'.$rows[$keys[$i]].'"';
                }
                else
                {
                    $update .= $keys[$i].'='.$rows[$keys[$i]];
                }

                // Parse to add commas
                if($i != count($rows)-1)
                {
                    $update .= ',';
                }
            }
            $update .= ' WHERE '.$where;
            $query = @mysql_query($update);
            if($query)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    /*
    * Returns the result set
    */
    public function getResult()
    {
        return $this->result;
    }
}
?>
