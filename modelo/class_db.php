<?php
//CREAMOS LA CLASE CON EL NOMBRE DB
class db {
//CREAMOS LOS ATRIBUTOS DE MANERA PRIVADA
	public $dns="localhost",
			$usuario="",
			$password="",
			$db="",
			$res,
			$mysqli;
			
//ESTOS SON TODOS LOS METODOS DE ENTRADA DE LA CLASE DB

//EL METODO CONSTRUCTOR CREA UNA CONEXION NO PERMATENTE A LA BASE DE DATOS		
	public function __CONSTRUCT(){
		$this->mysqli= new mysqli($this->dns,$this->usuario, $this->password,$this->db);
		$this->mysqli->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	}
//LA FUNCION EJECUTAR RECIBE LA SENTENCIA SQL Y EJECUTA EL QUERY, TAMBIEN DEVUELVE SI AFECTO LA DB O EN CASO E DEVOLVER 0 ES PORQUE HUBO UN ERROR
	public function ejecutar($sql){
			//exit($sql);
			//$this->res=odbc_exec($this->con,$sql) or die(odbc_errormsg ($this->con));
			$this->res=$this->mysqli->query($sql) or die($this->errores($this->mysqli->errno,$this->mysqli->error,$sql));

			return $this->mysqli->affected_rows;		
	}

	public function preparar($sql){
			$this->res=$this->mysqli->prepare($sql);	
	}
	public function parametro($cant,$parametro){
			$this->res->bind_param($cant, $parametro);	
	}
	public function ejecutar_preparado(){
			$this->res->execute();	
	}
	public function errores($nro,$error,$sql){
		$_SESSION['msj_tipo']="danger";
		switch($nro){
			case 1062: {
				
				$_SESSION['msj']="Disculpe este registro ya existe, verifique e intente nuevamente.";
				$_SESSION['redireccion']=$_SERVER['HTTP_REFERER'];
				$this->registrar_bitacora('Intento de registro repetido','Sentencia usada: '.$sql);
			}
			break;
			default:{
				$_SESSION['msj']="Disculpe su petición no se realizo correctamente, intente de nuevo o contacte al administrador.";
				$this->registrar_bitacora('Error interno','Nro. '.$nro.' '.$this->mysqli->error.'. SQL: '.$sql);
			}
		}
		header('location:'.$_SERVER['REQUEST_URI']);
	}
//LA FUNCION ROW EXTRAE EL RESULTADO DEL QUERY RETORNANDO UN ARREGLO
	public function row(){
		return $this->res->fetch_assoc();

	}
	public function row_juez(){
		return $this->res->fetch_row();

	}
//FUNCIONES PARA UNA TRANSACCION SEGURA
	public function INICIAR_TRANSACCION(){
		//$this->mysqli->begin_transaction(MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);
		
	}
	public function COMMIT(){
		//$this->mysqli->commit();
	}
	public function ROLLBACK(){
		//$this->mysqli->rollback();
	}
	

	public function registrar_bitacora($evento,$descripcion){
		$descripcion=$this->mysqli->real_escape_string($descripcion);
		$sql="INSERT INTO bitacora (evento,descripcion,cod_usuario) VALUES('".$evento."','".$descripcion."',".$_SESSION['cod_usuario'].")";
		$this->ejecutar($sql);
	}
}
?>
