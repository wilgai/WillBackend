<?php
class Usuario{
    //DB Properties
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
    public $estado;
    public $sexo;


    public function __construct($db){
        $this->conn=$db;
    }

    public function create()
    {
        $query='INSERT INTO '.$this->table .'
        SET 
        nombre = :nombre,
        direccion = :direccion,
        identificacion = :identificacion,
        telefono = :telefono,
        correo = :correo,
        usuario = :usuario ,
        tipo_usuario = :tipo_usuario ,
        contrasena = :contrasena,
        estado = :estado ,
        sexo = :sexo ';

         //Prepare staement
        $stmt=$this->conn->prepare($query);

        //Clean Data
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->direccion = htmlspecialchars(strip_tags($this->direccion));
        $this->identificacion = htmlspecialchars(strip_tags($this->identificacion));
        $this->correo = htmlspecialchars(strip_tags($this->correo));
        $this->usuario = htmlspecialchars(strip_tags($this->usuario));
        $this->tipo_usuario = htmlspecialchars(strip_tags($this->tipo_usuario));
        $this->contrasena = htmlspecialchars(strip_tags($this->contrasena));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->sexo = htmlspecialchars(strip_tags($this->sexo));
        //Bind Data
       
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':direccion', $this->direccion);
        $stmt->bindParam(':identificacion', $this->identificacion);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':correo', $this->correo);
        $stmt->bindParam(':usuario', $this->usuario);
        $stmt->bindParam(':tipo_usuario', $this->tipo_usuario);
        $stmt->bindParam(':contrasena', $this->contrasena);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':sexo', $this->sexo);
        //Execute query
        if($stmt->execute())
        {
            return true;
        }
        printf("Error: %s.\n",$stmt->error);
        return false;
    }

    public function read()
    {
        $query=' SELECT *FROM '.$this->table;
        //Prepare statement
        $stmt=$this->conn->prepare($query);
        //Execute query
        $stmt->execute();
        return $stmt;
    }

    public function read_single()
    {
        $query= ' SELECT *FROM '.$this->table . ' WHERE Id=? ';
        //Prepare statement
        $stmt=$this->conn->prepare($query);
        //Bind param
        $stmt->bindParam(1, $this->Id);
        //Execute Statement
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        //Set properties
        $this->id=$row['Id'];
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
        $this->sexo=$row['sexo'];
    }

    public  function CheckEmail()
    {
        $query= ' SELECT *FROM '.$this->table . ' WHERE correo=? ';
        //Prepare statement
        $stmt=$this->conn->prepare($query);
        //Bind param
        $stmt->bindParam(1, $this->correo);
        //Execute Statement
        $stmt->execute();
        return $stmt;
        /*if($stmt->rowCount() > 0)
        {
            return true;
        }*/
    }

    public  function CheckIdentification()
    {
        $query= ' SELECT *FROM '.$this->table . ' WHERE identificacion=? ';
        //Prepare statement
        $stmt=$this->conn->prepare($query);
        //Bind param
        $stmt->bindParam(1, $this->identificacion);
        //Execute Statement
        $stmt->execute();
        return $stmt;
    }

    public function update()
    {
        $query=' UPDATE '.$this->table .'
        SET 
        nombre = :nombre,
        direccion = :direccion,
        identificacion = :identificacion,
        telefono = :telefono,
        correo = :correo,
        usuario = :usuario ,
        tipo_usuario = :tipo_usuario ,
        contrasena = :contrasena,
        estado = :estado ,
        sexo = :sexo 
        WHERE
        Id = :Id';
        $stmt=$this->conn->prepare($query);
        //Clean Data
        //Clean 
        $this->Id = htmlspecialchars(strip_tags($this->Id));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->direccion = htmlspecialchars(strip_tags($this->direccion));
        $this->identificacion = htmlspecialchars(strip_tags($this->identificacion));
        $this->correo = htmlspecialchars(strip_tags($this->correo));
        $this->usuario = htmlspecialchars(strip_tags($this->usuario));
        $this->tipo_usuario = htmlspecialchars(strip_tags($this->tipo_usuario));
        $this->contrasena = htmlspecialchars(strip_tags($this->contrasena));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->sexo = htmlspecialchars(strip_tags($this->sexo));
        //Bind Data
        $stmt->bindParam(':Id', $this->Id);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':direccion', $this->direccion);
        $stmt->bindParam(':identificacion', $this->identificacion);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':correo', $this->correo);
        $stmt->bindParam(':usuario', $this->usuario);
        $stmt->bindParam(':tipo_usuario', $this->tipo_usuario);
        $stmt->bindParam(':contrasena', $this->contrasena);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':sexo', $this->sexo);
        //Execute query
        $stmt->execute();
        if($stmt->execute()){
            return true;
        }
        //Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
       return false;
    }
    public function delete()
    {
        $query= ' DELETE FROM ' . $this->table . ' 
        WHERE
        Id = :Id';
        //Prepare statement
        $stmt = $this->conn->prepare($query);
        //Clean data
        $this->Id = htmlspecialchars(strip_tags($this->Id));
        //Bind data
        $stmt->bindParam(':Id', $this->Id);
        //Execute query
        if($stmt->execute()){
            return true;
        }
        //Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
       return false;

    }
    public function lockUser()
    {
        $query=' UPDATE '.$this->table .'
        SET 
        nombre = :nombre,
        direccion = :direccion,
        identificacion = :identificacion,
        telefono = :telefono,
        correo = :correo,
        usuario = :usuario ,
        tipo_usuario = :tipo_usuario ,
        contrasena = :contrasena,
        estado = :estado ,
        sexo = :sexo 
        WHERE
        Id = :Id';
        $stmt=$this->conn->prepare($query);
        //Clean Data
        //Clean 
        $this->Id = htmlspecialchars(strip_tags($this->Id));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->direccion = htmlspecialchars(strip_tags($this->direccion));
        $this->identificacion = htmlspecialchars(strip_tags($this->identificacion));
        $this->correo = htmlspecialchars(strip_tags($this->correo));
        $this->usuario = htmlspecialchars(strip_tags($this->usuario));
        $this->tipo_usuario = htmlspecialchars(strip_tags($this->tipo_usuario));
        $this->contrasena = htmlspecialchars(strip_tags($this->contrasena));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->sexo = htmlspecialchars(strip_tags($this->sexo));
        //Bind Data
        $stmt->bindParam(':Id', $this->Id);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':direccion', $this->direccion);
        $stmt->bindParam(':identificacion', $this->identificacion);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':correo', $this->correo);
        $stmt->bindParam(':usuario', $this->usuario);
        $stmt->bindParam(':tipo_usuario', $this->tipo_usuario);
        $stmt->bindParam(':contrasena', $this->contrasena);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':sexo', $this->sexo);
        //Execute query
        $stmt->execute();
        if($stmt->execute()){
            return true;
        }
        //Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
       return false;
    }
}