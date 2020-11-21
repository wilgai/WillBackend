<?php
class Suplidor{
    //DB Properties
    private $conn;
    private $table='suplidor';
    //Properties
    public $Id;
    public $nombre;
    public $rnc;
    public $direccion;
    public $telefono;
    public $correo;
    public $web;
    public $tipo;
    public $logo;


    public function __construct($db){
        $this->conn=$db;
    }

    public function create()
    {
        $query='INSERT INTO '.$this->table .'
        SET 
        nombre = :nombre,
        rnc = :rnc,
        direccion = :direccion,
        telefono = :telefono,
        correo = :correo,
        web = :web ,
        tipo = :tipo,
        logo = :logo ';
         //Prepare staement
        $stmt=$this->conn->prepare($query);
        //Clean Data
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->rnc = htmlspecialchars(strip_tags($this->rnc));
        $this->direccion = htmlspecialchars(strip_tags($this->direccion));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->correo = htmlspecialchars(strip_tags($this->correo));
        $this->web = htmlspecialchars(strip_tags($this->web));
        $this->tipo = htmlspecialchars(strip_tags($this->tipo));
        $this->logo = htmlspecialchars(strip_tags($this->logo));
        //Bind Data
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':rnc', $this->rnc);
        $stmt->bindParam(':direccion', $this->direccion);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':correo', $this->correo);
        $stmt->bindParam(':web', $this->web);
        $stmt->bindParam(':tipo', $this->tipo);
        $stmt->bindParam(':logo', $this->logo);
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
        $query= ' SELECT *FROM '.$this->table ;
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
        $this->rnc=$row['rnc'];
        $this->telefono=$row['telefono'];
        $this->correo=$row['correo'];
        $this->web=$row['web'];
        $this->tipo=$row['tipo'];
        $this->foto=$row['foto'];
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
    public  function CheckName()
    {
        $query= ' SELECT *FROM '.$this->table . ' WHERE nombre=? ';
        //Prepare statement
        $stmt=$this->conn->prepare($query);
        //Bind param
        $stmt->bindParam(1, $this->nombre);
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
        $query= ' SELECT *FROM '.$this->table . ' WHERE rnc=? ';
        //Prepare statement
        $stmt=$this->conn->prepare($query);
        //Bind param
        $stmt->bindParam(1, $this->rnc);
        //Execute Statement
        $stmt->execute();
        return $stmt;
    }

    public function update()
    {
        $query=' UPDATE '.$this->table .'
        SET 
        nombre = :nombre,
        rnc = :rnc,
        direccion = :direccion,
        telefono = :telefono,
        correo = :correo,
        web = :web ,
        tipo = :tipo,
        logo = :logo ';
        $stmt=$this->conn->prepare($query);
       //Clean Data
       $this->nombre = htmlspecialchars(strip_tags($this->nombre));
       $this->rnc = htmlspecialchars(strip_tags($this->rnc));
       $this->direccion = htmlspecialchars(strip_tags($this->direccion));
       $this->telefono = htmlspecialchars(strip_tags($this->telefono));
       $this->correo = htmlspecialchars(strip_tags($this->correo));
       $this->web = htmlspecialchars(strip_tags($this->web));
       $this->tipo = htmlspecialchars(strip_tags($this->tipo));
       $this->logo = htmlspecialchars(strip_tags($this->logo));
       //Bind Data
       $stmt->bindParam(':nombre', $this->nombre);
       $stmt->bindParam(':rnc', $this->rnc);
       $stmt->bindParam(':direccion', $this->direccion);
       $stmt->bindParam(':telefono', $this->telefono);
       $stmt->bindParam(':correo', $this->correo);
       $stmt->bindParam(':web', $this->web);
       $stmt->bindParam(':tipo', $this->tipo);
       $stmt->bindParam(':logo', $this->logo);
        //Execute query
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
}