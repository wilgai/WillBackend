<?php

class Login 
{
	private $conn;
    private $table='usuario';
    //Properties
    public $Id;
    public $nombre;
    public $direccion;
    public $identificacion;
    public $telefono;
    public $correo;
    public $usuario;
    public $tipo_usuario;
    public $contrasena;
    public function __construct($db){
        $this->conn=$db;
	}
	public function login()
    {
        $query= " SELECT *FROM ".$this->table . " WHERE usuario= '".$this->usuario."' AND contrasena ='".$this->contrasena."'  ";
        //Prepare statement
		$stmt=$this->conn->prepare($query);
        //Execute Statement
		$stmt->execute();
		return $stmt;
      
	}
	


	








	
}
?>