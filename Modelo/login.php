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
        //$row=$stmt->fetch(PDO::FETCH_ASSOC);
        //Set properties
        /*$this->id=$row['Id'];
        $this->nombre=$row['nombre'];
        $this->direccion=$row['direccion'];
        $this->identificacion=$row['identificacion'];
        $this->telefono=$row['telefono'];
        $this->correo=$row['correo'];
        $this->usuario=$row['usuario'];
        $this->tipo_usuario=$row['tipo_usuario'];
        $this->contrasena=$row['contrasena'];
        $this->tipo_usuario=$row['tipo_usuario'];
        $this->estado=$row['estado'];
        $this->sexo=$row['sexo'];*/
	}
	


	








	
}
?>