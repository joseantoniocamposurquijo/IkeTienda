<?php
/**
* ----------------------------------------------------------
* Clase AppForms
* Funciones de conexion con la base de datos
* @return connection to database + mechanism to query
* @version 1
* @package Model
* @author Jose Antonio Campos Urquijo
* @copyright  Copyright (c)
* ----------------------------------------------------------
*/


class Mysql {

	private $connection;
	private $userSession;
	private $clientIP;
	private $query;
	private $dataInsert;
	private $table;
	private $queryType;
	private $dataUpdate;
	private $idDelete;


	public function __construct(){

		// Conexión con la base de datos de acuerdo al tipo de motor de base de datos
		try {
			$this->connection = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPW, [PDO::MYSQL_ATTR_LOCAL_INFILE => true]);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->connection->exec("SET CHARACTER SET ".DBCHARSET);
		} catch (Exception $e) {
			$exception = ['message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile(), 'code' => $e->getCode()];
			debug($exception, true);
		}	

	}


	private function connection() {

		return $this->connection;
	
	}



	// Función para ejecutar un query tipo insert.
	public function insert($strQuery, $dataInsert, $table){

		$this->query = $strQuery;
		$this->dataInsert = $dataInsert;
		$this->table = $table;
		$this->queryType = 'Insert';

		if(stripos($this->query, 'insert') != false){
			die('la consulta no es de inserccion en: '.__FILE__.', line: '.__LINE__);
		}

		if(!stripos($this->query, $this->table)){
			die('el nombre de la tabla ('.$table.') no esta definido en la consulta en: '.__FILE__.', line: '.__LINE__);
		}

		try {

			$connection = $this->connection();
			$var = $this->variables();
			$this->setUser(); // Se define la variable @UseId para logs

			// Se ejecuta la consulta principal.
			$insert = $connection->prepare($this->query);
			$result = $insert->execute($this->dataInsert);

			$insert->closeCursor();

			// Registro en la tabla de logs para auditoría.
			$this->log($this->query, $this->queryType, $this->table, $this->dataInsert);		
			return true;

		} catch(PDOException $e) {
		
			$exception = ['message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile(), 'code' => $e->getCode()];
			debug($exception);
			debug(debug_backtrace(),1);
	    
	    } finally {
	    	
	    	$insert = null;
	    	$result = null;
			$connection = null;
	    
	    }

	}


	// Función para ejecutar un query tipo update, delete.
	public function update($strQuery, $dataUpdate, $table){

		$this->query = $strQuery;
		$this->dataUpdate = $dataUpdate;
		$this->table = $table;
		$this->queryType = 'Update';

		try {

			$connection = $this->connection();
			$var = $this->variables();
			$this->setUser(); // Se define la variable @UseId para efectos del trigger.
			
			// Se ejecuta la consulta principal.
			$update = $connection->prepare($this->query);
			$result = $update->execute($this->dataUpdate);
			$update->closeCursor();

			// Registro en la tabla de logs para auditoría.
			$this->log($this->query, $this->queryType, $this->table, $this->dataUpdate);

			return true;

		} catch(PDOException $e) {
		
			$exception = ['message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile(), 'code' => $e->getCode()];
			debug($exception);
			debug(debug_backtrace(),1);
	    
	    } finally {
	    
	    	$result = null;
			$connection = null;
	    
	    }

	}



	// Función para ejecutar un query tipo update, delete.
	public function delete($strQuery, $idDelete, $table){

		$this->query = $strQuery;
		$this->table = $table;
		$this->queryType = 'Delete';
		$this->idDelete = $idDelete;

		try {

			$connection = $this->connection();
			$var = $this->variables();

			// Se define la variable @UseId para efectos del trigger.
			$this->setUser();
			
			// Se ejecuta la consulta principal.
			$delete = $connection->prepare($this->query);
			$result = $delete->execute($this->idDelete);

			$delete->closeCursor();

			// Registro en la tabla de logs para auditoría.
			$this->log($this->query, $this->queryType, $this->table, json_encode($this->idDelete));

			return true;

		} catch(PDOException $e) {
		
			$exception = ['message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile(), 'code' => $e->getCode()];
			debug($exception);
			debug(debug_backtrace(),1);
	    
	    } finally {
	    
	    	$result = null;
			$connection = null;
	    
	    }

	}



	// Funcion para devolver una consulta completa vista tabla bd
	public function all($strQuery, $typeResult=null){

		$this->query = $strQuery;

		try {
			// Posibles valores $typeResult: PDO::FETCH_NUM, PDO::FETCH_ASSOC
			$typeResult = empty($typeResult) || is_null($typeResult) ? 
							PDO::FETCH_ASSOC : 
							$typeResult;

			$connection = $this->connection();
			
			$result = $connection->prepare($this->query);
			$result->execute();
			$data = $result->fetchall($typeResult);
			$rowCount = $result->rowCount();
			$columnCount = $result->columnCount();
			
			for ($i = 0; $i < $columnCount; $i ++) {
	    		$getColumnMeta = $result->getColumnMeta($i);
	    		$columnName[] = $getColumnMeta['name'];
			}

			$result->closeCursor();

			return [
				'data' => $data, 
				'rowCount' => $rowCount, 
				'columnCount' => $columnCount,
				'columnName' => $columnName
			];

		} catch(PDOException $e) {

			$errorException = ['message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile(), 'code' => $e->getCode()];
			debug($exception);
			debug(debug_backtrace(),1);
	    
	    } finally {
	    
	    	$result = null;
			$connection = null;
	    
	    }

	}


	
	public function row($strQuery, $typeResult=null){

		// Posibles valores $typeResult: 
		// Ejm: AppQuery::Row($sql, PDO::FETCH_NUM);
		$this->query = $strQuery;

		try {

			$typeResult = empty($typeResult) || is_null($typeResult) ? 
							PDO::FETCH_ASSOC : 
							$typeResult;

			// Se agrega la instruccíón limit 1 en caso de no tenerla.
			$this->query = !strpos($this->query, 'LIMIT') ? $this->query." LIMIT 1" : $this->query;

			// Ejecución del query
			$connection = $this->connection();
			$result = $connection->prepare($this->query);
			$result->execute();

			// Retorno de datos 
			$data = $result->fetch($typeResult);
			$columnCount = $result->columnCount();
			for ($i = 0; $i < $columnCount; $i ++) {
	    		$getColumnMeta = $result->getColumnMeta($i);
	    		$columnName[] = $getColumnMeta['name'];
			}

			switch ($typeResult) {
				case PDO::FETCH_NUM:
					return $data;
					break;
				
				default:
					return [
						'data' => !empty($data) ? $data : null,
						'columnCount' => $columnCount,
						'columnName' => $columnName
					];
					break;
			}

		} catch(PDOException $e) {

			$errorException = ['message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile(), 'code' => $e->getCode()];
			debug($exception);
			debug(debug_backtrace(),1);
	    
	    } finally {
	    
	    	$result = null;
			$connection = null;
	    
	    }
		
	}



	public function value($strQuery){

		$this->query = $strQuery;

		if(!strpos($this->query, ',')){
			$result = $this->Row($this->query, PDO::FETCH_NUM);
			return !empty($result[0]) ? $result[0] : null;
		}else {
			debug('Instrucción sql ('.$this->query.') inválida, utilice el método "Row"'.__FILE__.__LINE__, 1);
		}

	} // End Method Value


	private function variables(){
		
		$this->userSession = 'Sistema';

		// isset($_SESSION["appSessionUseId"]) ? $_SESSION["appSessionUseId"] : 'system';

		$this->clientIP = 'IP: '.getIP()." - Browser: ".getBrowser($_SERVER['HTTP_USER_AGENT']);

		return [
			'userSession' => $this->userSession,
			'clientIP' => $this->clientIP,
		];

	}


	private function log($strQuery, $queryType, $table, $arrValues) {

		$connection = $this->connection();
		$var = $this->variables();
		$strQuery = addslashes($strQuery);

		// Datos a insertar en la tabla logs sql
		$sql = "INSERT INTO logs (LoQueryType, LoTable, LoUser, LoQuery, LoValues, LoIp, created_at) VALUES (?, ?, ?, ?, ?, ?, ?);";
		$data = [$queryType, $table, $var['userSession'], $strQuery, json_encode($arrValues), $var['clientIP'], date('Y-m-d H:i:s')];
	
		// Ejecución de la consulta
		$result = $connection->prepare($sql);
		$result->execute($data);
		$result->closeCursor();

	}


	private function setUser() {

		$connection = $this->connection();

		$var = $this->variables();

		if(!empty($var['userSession'])){

			$sql = "set @UseId='{$var['userSession']}';";
			$result = $connection->prepare($sql);
			$result->execute();
			$result->closeCursor();

		}

	}

}

?>