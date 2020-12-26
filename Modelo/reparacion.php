<?php
class Reparacion 
{
    private $conn;
    private $table='reparacion';
    private $table1='detalle_rep';


    
    /*--------------Factura--------------------*/ 
        public $Id;
        public $cliente;
        public $detalle;
        public $numero;
        public $total;
        public $resgistradoPor;
        public $fecha;
        public $estado;
        public $metPago;
        public $DeletedOrderItemIDs;
       
    /*--------------Detalle Factura--------------------*/ 
   
        public $idDetalle ;
        public $equipo;
        public $cantidad ;
        public $costo ;
        public $ref;	 
        public $IdRep;
       
        public function __construct($db){
            $this->conn=$db;
        }
        public function create()
        {
            $query='INSERT INTO '.$this->table .'
            SET 
            Id = :Id,
            cliente = :cliente,
            detalle = :detalle,
            numero = :numero,
            total = :total,
            resgistradoPor = :resgistradoPor,
            fecha = :fecha ,
            estado = :estado ,
            metPago = :metPago';

             //Prepare staement
            $stmt=$this->conn->prepare($query);
            //Clean Data
            $this->Id = rand();
            $this->cliente = htmlspecialchars(strip_tags($this->cliente));
            $this->detalle = htmlspecialchars(strip_tags($this->detalle));
            $this->numero = htmlspecialchars(strip_tags($this->numero));
            $this->total = htmlspecialchars(strip_tags($this->total));
            $this->resgistradoPor = htmlspecialchars(strip_tags($this->resgistradoPor));
            $this->fecha = htmlspecialchars(strip_tags($this->fecha));
            $this->estado = htmlspecialchars(strip_tags($this->estado));
            $this->metPago = htmlspecialchars(strip_tags($this->metPago));
            
            
            //Bind Data
            $stmt->bindParam(':Id', $this->Id);
            $stmt->bindParam(':cliente', $this->cliente);
            $stmt->bindParam(':detalle', $this->detalle);
            $stmt->bindParam(':numero', $this->numero);
            $stmt->bindParam(':total', $this->total);
            $stmt->bindParam(':resgistradoPor', $this->resgistradoPor);
            $stmt->bindParam(':fecha', $this->fecha);
            $stmt->bindParam(':estado', $this->estado);
            $stmt->bindParam(':metPago', $this->metPago);
            //Execute query
            if($stmt->execute())
            {
                foreach (json_decode($this->repDet,true) as $row ) {

                    
                    $query="INSERT INTO detalle_rep VALUES('','".$row["equipo"]."','".$row["cantidad"]."',
    		    	'".$row["costo"]."','".$row["ref"]."','".$row["IdRep"]."','".$row["estado"]."','".$row["detalle"]."')";
                    $stmt=$this->conn->prepare($query);
                    $stmt->execute(); 
                }
                return true; 
            }
            
            
        }
        

        public function read(){
        $query='SELECT 
        r.Id,
        r.cliente,
        r.detalle,
        r.numero,
        r.total,
        r.resgistradoPor,
        DATE_FORMAT(r.fecha, "%d-%m-%Y, %H:%i %p" ) AS fecha ,
        r.estado,
        r.metPago,
        u.Id AS IdUsuario,
        u.nombre
        FROM 
        reparacion r
        INNER JOIN usuario u ON r.resgistradoPor = u.Id';
        //Prepare statement
        $stmt=$this->conn->prepare($query);
        //Execute query
        $stmt->execute();
        return $stmt;
    }
  
        public function update()
        {
            $query='UPDATE '.$this->table .'
            SET 
         
            Id = :Id,
            cliente = :cliente,
            detalle = :detalle,
            numero = :numero,
            total = :total,
            resgistradoPor = :resgistradoPor,
            fecha = :fecha ,
            estado = :estado ,
            metPago = :metPago 
            WHERE
            Id = :Id';

            
             //Prepare staement
            $stmt=$this->conn->prepare($query);
            //Clean Data
            $this->Id = htmlspecialchars(strip_tags($this->Id));
            $this->cliente = htmlspecialchars(strip_tags($this->cliente));
            $this->detalle = htmlspecialchars(strip_tags($this->detalle));
            $this->numero = htmlspecialchars(strip_tags($this->numero));
            $this->total = htmlspecialchars(strip_tags($this->total));
            $this->resgistradoPor = htmlspecialchars(strip_tags($this->resgistradoPor));
            $this->fecha = htmlspecialchars(strip_tags($this->fecha));
            $this->estado = htmlspecialchars(strip_tags($this->estado));
            $this->metPago = htmlspecialchars(strip_tags($this->metPago));
            //Bind Data
            $stmt->bindParam(':Id', $this->Id);
            $stmt->bindParam(':cliente', $this->cliente);
            $stmt->bindParam(':detalle', $this->detalle);
            $stmt->bindParam(':numero', $this->numero);
            $stmt->bindParam(':total', $this->total);
            $stmt->bindParam(':resgistradoPor', $this->resgistradoPor);
            $stmt->bindParam(':fecha', $this->fecha);
            $stmt->bindParam(':estado', $this->estado);
            $stmt->bindParam(':metPago', $this->metPago);
            //Execute query
            if($stmt->execute())
            {  
                foreach (json_decode($this->repDet,true) as $row ) {
                    if($row["idDetalle"] ==0){   

                    $query="INSERT INTO detalle_rep VALUES ('','".$row["equipo"]."', '".$row["cantidad"]."',
    		    	'".$row["costo"]."', '".$row["ref"]."', '".$row["IdRep"]."', '".$row["estado"]."', '".$row["detalle"]."')";
                    $stmt=$this->conn->prepare($query);
                    $stmt->execute(); 

                    }
                    else{
                        $query="UPDATE  detalle_rep SET equipo='".$row["equipo"]."',cantidad='".$row["cantidad"]."',
                        costo='".$row["costo"]."',ref='".$row["ref"]."',IdRep='".$row["IdRep"]."',estado='".$row["estado"]."',detalle='".$row["detalle"]."'
                        WHERE Id='".$row["idDetalle"]."' ";
                        $stmt=$this->conn->prepare($query);
                        $stmt->execute();

                    }
                
                }
                $itemsToDelete=explode(',',$this->DeletedOrderItemIDs); 
                foreach ( $itemsToDelete as $Id) {
                    $query= ' DELETE FROM detalle_rep
                            WHERE
                            Id = :Id';
                            $stmt = $this->conn->prepare($query);
                            $stmt->bindParam(':Id', $Id);
                           $stmt->execute();         
                    }
            }

           
            return true;
        }

    public function getReparacionById(){
        $query= ' SELECT  
        Id,
        cliente,
        detalle,
        numero,
        total,
        resgistradoPor,
        DATE_FORMAT(fecha, "%d-%m-%Y, %H:%i %p" ) AS fecha ,
        estado,
        metPago
        FROM '.$this->table . '
        WHERE numero=?  ';
        //Prepare statement
        $stmt=$this->conn->prepare($query);
        //Bind param
        $stmt->bindParam(1, $this->numero);
        //Execute Statement
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        //Set properties
        $this->Id=$row['Id'];
        $this->cliente=$row['cliente'];
        $this->detalle=$row['detalle'];
        $this->numero=$row['numero'];
        $this->total=$row['total'];
        $this->resgistradoPor=$row['resgistradoPor'];
        $this->fecha=$row['fecha'];
        $this->estado=$row['estado'];
        $this->metPago=$row['metPago'];
        $query= '
        SELECT
         d.Id AS idDetalle,
         d.equipo,
         d.cantidad,
         d.costo,
         d.costo * d.cantidad As Total,
         d.ref,
         d.IdRep,
         d.estado,
         d.detalle
         FROM 
         detalle_rep d
         INNER JOIN
         reparacion r
         ON
         d.IdRep=r.numero
         WHERE d.IdRep=? ';
         $stmt=$this->conn->prepare($query);
         //Bind param
         $stmt->bindParam(1, $this->numero);
         //Execute Statement
         $stmt->execute();
        return $stmt;
    }
}

        


