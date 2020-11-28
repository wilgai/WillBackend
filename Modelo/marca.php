<?php
class Marca{
    //DB Properties
    private $conn;
    private $table='marca';
    //Properties
    public $Id;
    public $nombre;
    


    public function __construct($db){
        $this->conn=$db;
    }

    public function create()
    {
        $query='INSERT INTO '.$this->table .'
        SET 
        nombre = :nombre';

         //Prepare staement
        $stmt=$this->conn->prepare($query);

        //Clean Data
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        //Bind Data
       
        $stmt->bindParam(':nombre', $this->nombre);
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
    }

    public function update()
    {
        $query=' UPDATE '.$this->table .'
        SET 
        nombre = :nombre 
        WHERE
        Id = :Id';
        $stmt=$this->conn->prepare($query);
        //Clean Data
        //Clean Data
        $this->Id = htmlspecialchars(strip_tags($this->Id));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));

        //Bind Data
        $stmt->bindParam(':Id', $this->Id);
        $stmt->bindParam(':nombre', $this->nombre);
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
}