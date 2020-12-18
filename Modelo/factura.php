<?php
class Factura 
{
    private $conn;
    private $table='factura';
    private $table1='detalle_factura';
    /*--------------Factura--------------------*/ 
        public $Id;
        public $fecha;
        public $usuario_registro;
        public $codigoCliente;
        public $tipoDocumento;
        public $ncf;
        public $referencia;
        public $descuento;
        public $detalle;
        public $totaln;
        public $itbistot;
        public $suplidor;
        public $OrderNumber;
        public $metPago;
        public $DeletedOrderItemIDs;
    /*--------------Detalle Factura--------------------*/ 
        public $idDetalle ;
        public $codigo_articulo;
        public $cantidad ;
        public $precio ;
        public $idFactura;	 
        public $itbis;
        public $ref;
        public $orderDet;
        
        public function __construct($db){
            $this->conn=$db;
        }
        public function create()
        {
            $query='INSERT INTO '.$this->table .'
            SET 
            Id = :Id,
            usuario_registro = :usuario_registro,
            codigoCliente = :codigoCliente,
            tipoDocumento = :tipoDocumento,
            ncf = :ncf,
            referencia = :referencia,
            descuento = :descuento ,
            detalle = :detalle ,
            totaln = :totaln,
            itbistot = :itbistot,
            fecha = :fecha,
            suplidor = :suplidor, 
            OrderNumber = :OrderNumber,
            metPago =:metPago
           ';

             //Prepare staement
            $stmt=$this->conn->prepare($query);
            //Clean Data
            $this->Id = rand();
            $this->usuario_registro = htmlspecialchars(strip_tags($this->usuario_registro));
            $this->codigoCliente = htmlspecialchars(strip_tags($this->codigoCliente));
            $this->tipoDocumento = htmlspecialchars(strip_tags($this->tipoDocumento));
            $this->ncf = htmlspecialchars(strip_tags($this->ncf));
            $this->referencia = htmlspecialchars(strip_tags($this->referencia));
            $this->descuento = htmlspecialchars(strip_tags($this->descuento));
            $this->detalle = htmlspecialchars(strip_tags($this->detalle));
            $this->totaln = htmlspecialchars(strip_tags($this->totaln));
            $this->itbistot = htmlspecialchars(strip_tags($this->itbistot));
            $this->fecha = htmlspecialchars(strip_tags($this->fecha));
            $this->suplidor = htmlspecialchars(strip_tags($this->suplidor));
            $this->OrderNumber = htmlspecialchars(strip_tags($this->OrderNumber));
            $this->metPago = htmlspecialchars(strip_tags($this->metPago));
            
            //Bind Data
            $stmt->bindParam(':Id', $this->Id);
            $stmt->bindParam(':usuario_registro', $this->usuario_registro);
            $stmt->bindParam(':codigoCliente', $this->codigoCliente);
            $stmt->bindParam(':tipoDocumento', $this->tipoDocumento);
            $stmt->bindParam(':ncf', $this->ncf);
            $stmt->bindParam(':referencia', $this->referencia);
            $stmt->bindParam(':descuento', $this->descuento);
            $stmt->bindParam(':detalle', $this->detalle);
            $stmt->bindParam(':totaln', $this->totaln);
            $stmt->bindParam(':itbistot', $this->itbistot);
            $stmt->bindParam(':fecha', $this->fecha);
            $stmt->bindParam(':suplidor', $this->suplidor);
            $stmt->bindParam(':OrderNumber', $this->OrderNumber);
            $stmt->bindParam(':metPago', $this->metPago);
          
            //Execute query
            if($stmt->execute())
            {
                foreach (json_decode($this->orderDet,true) as $row ) {
                    if($this->tipoDocumento=='Factura'){
                    $query="INSERT INTO detalle_factura VALUES('','".$row["codigo_articulo"]."','".$row["cantidad"]."',
    		    	'".$row["PrecioVenta"]."','".$row["idFactura"]."','".$row["itbis"]."','".$row["IdInventario"]."','".$row["ref"]."')";
                    $stmt=$this->conn->prepare($query);
                    $stmt->execute(); 

                    //Update inventory code here
                    $query="UPDATE inventario SET Cantidad=Cantidad -'".$row["cantidad"]."' WHERE Id='".$row["IdInventario"]."' ";
                    $stmt=$this->conn->prepare($query);
                    $stmt->execute();
                }
                else{
                    $query="INSERT INTO detalle_factura VALUES('','".$row["codigo_articulo"]."','".$row["cantidad"]."',
    		    	'".$row["PrecioVenta"]."','".$row["idFactura"]."','".$row["itbis"]."','','".$row["ref"]."')";
                    $stmt=$this->conn->prepare($query);
                    $stmt->execute(); 

                    //Insert into Inventory code here
                    $query="INSERT INTO inventario VALUES('','".$row["codigo_articulo"]."','".$row["PrecioCompra"]."',
    		    	'".$row["Ganancia"]."','".$row["PrecioVenta"]."','".$row["cantidad"]."','".$this->fecha."','".$row["itbis"]."','".$row["ref"]."','".$row["idFactura"]."')";
                    $stmt=$this->conn->prepare($query);
                    $stmt->execute(); 

                }

                }
                return true; 
            }
            
            
        }
        

        public function read(){
        $query='SELECT 
        f.Id,
        f.codigoCliente,
        f.tipoDocumento,
        f.ncf,
        f.referencia,
        f.descuento,
        f.detalle,
        f.totaln,
        f.itbistot,
        DATE_FORMAT(f.fecha, "%d-%m-%Y, %H:%i %p" ) AS fecha ,
        f.OrderNumber,
        f.metPago,
        u.Id AS usuario_registro,
        u.nombre,
        u.direccion,
        u.identificacion
        
        FROM 
        factura f
        INNER JOIN usuario u ON f.usuario_registro = u.Id 
        WHERE f.tipoDocumento="Factura"';
        //Prepare statement
        $stmt=$this->conn->prepare($query);
        //Execute query
        $stmt->execute();
        return $stmt;
    }
    public function readPurchases(){
        $query='SELECT 
        f.Id,
        f.codigoCliente,
        f.tipoDocumento,
        f.ncf,
        f.referencia,
        f.descuento,
        f.detalle,
        f.totaln,
        f.itbistot,
        DATE_FORMAT(f.fecha, "%d-%m-%Y, %H:%i %p" ) AS fecha ,
        f.OrderNumber,
        f.metPago,
        f.suplidor AS IdSuplidor,
        s.nombre AS Suplidor,
        u.Id AS usuario_registro,
        u.nombre,
        u.direccion,
        u.identificacion
        
        FROM 
        factura f
        INNER JOIN usuario u ON f.usuario_registro = u.Id 
        INNER JOIN suplidor s ON f.suplidor=s.Id
        WHERE f.tipoDocumento="Compra"';
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
            usuario_registro = :usuario_registro,
            codigoCliente = :codigoCliente,
            tipoDocumento = :tipoDocumento,
            ncf = :ncf,
            referencia = :referencia,
            descuento = :descuento ,
            detalle = :detalle ,
            totaln = :totaln,
            itbistot = :itbistot,
            fecha = :fecha,
            suplidor = :suplidor, 
            OrderNumber = :OrderNumber,
            metPago =:metPago
            WHERE
            Id = :Id';
             //Prepare staement
            $stmt=$this->conn->prepare($query);
            //Clean Data
            $this->Id = htmlspecialchars(strip_tags($this->Id));
            $this->usuario_registro = htmlspecialchars(strip_tags($this->usuario_registro));
            $this->codigoCliente = htmlspecialchars(strip_tags($this->codigoCliente));
            $this->tipoDocumento = htmlspecialchars(strip_tags($this->tipoDocumento));
            $this->ncf = htmlspecialchars(strip_tags($this->ncf));
            $this->referencia = htmlspecialchars(strip_tags($this->referencia));
            $this->descuento = htmlspecialchars(strip_tags($this->descuento));
            $this->detalle = htmlspecialchars(strip_tags($this->detalle));
            $this->totaln = htmlspecialchars(strip_tags($this->totaln));
            $this->itbistot = htmlspecialchars(strip_tags($this->itbistot));
            $this->fecha = htmlspecialchars(strip_tags($this->fecha));
            $this->suplidor = htmlspecialchars(strip_tags($this->suplidor));
            $this->OrderNumber = htmlspecialchars(strip_tags($this->OrderNumber));
            $this->metPago = htmlspecialchars(strip_tags($this->metPago));
            //Bind Data
            $stmt->bindParam(':Id', $this->Id);
            $stmt->bindParam(':usuario_registro', $this->usuario_registro);
            $stmt->bindParam(':codigoCliente', $this->codigoCliente);
            $stmt->bindParam(':tipoDocumento', $this->tipoDocumento);
            $stmt->bindParam(':ncf', $this->ncf);
            $stmt->bindParam(':referencia', $this->referencia);
            $stmt->bindParam(':descuento', $this->descuento);
            $stmt->bindParam(':detalle', $this->detalle);
            $stmt->bindParam(':totaln', $this->totaln);
            $stmt->bindParam(':itbistot', $this->itbistot);
            $stmt->bindParam(':fecha', $this->fecha);
            $stmt->bindParam(':suplidor', $this->suplidor);
            $stmt->bindParam(':OrderNumber', $this->OrderNumber);
            $stmt->bindParam(':metPago', $this->metPago);
            //Execute query
            if($stmt->execute())
            {  
                foreach (json_decode($this->orderDet,true) as $row ) {

                    if($row["idDetalle"]==0){
                        $query="INSERT INTO detalle_factura VALUES('','".$row["codigo_articulo"]."','".$row["cantidad"]."',
                        '".$row["PrecioVenta"]."','".$row["idFactura"]."','".$row["itbis"]."','".$row["ref"]."','".$row["IdInventario"]."')";
                        $stmt=$this->conn->prepare($query);
                        $stmt->execute();  
                    }
                    else{
                    $query="UPDATE  detalle_factura SET  codigo_articulo='".$row["codigo_articulo"]."',cantidad='".$row["cantidad"]."',
    		    	precio='".$row["PrecioVenta"]."',idFactura='".$row["idFactura"]."',itbis='".$row["itbis"]."',ref='".$row["ref"]."',IdInventario='".$row["IdInventario"]."'
                    WHERE Id='".$row["idDetalle"]."'";
                    $stmt=$this->conn->prepare($query);
                    $stmt->execute(); 
                    }
                }
                $itemsToDelete=explode(',',$this->DeletedOrderItemIDs); 
                foreach ( $itemsToDelete as $Id) {
                    $query= ' DELETE FROM detalle_factura
                            WHERE
                            Id = :Id';
                            $stmt = $this->conn->prepare($query);
                            $stmt->bindParam(':Id', $Id);
                           $stmt->execute();         
                    }
            }
           
            return true;
        }

    public function getOrderByID(){
        $query= ' SELECT  
        Id,
        usuario_registro, 
        codigoCliente,
        codigoCliente,
        tipoDocumento,
        ncf,
        referencia,
        descuento,
        totaln,
        itbistot,
        detalle,
        DATE_FORMAT(fecha, "%d-%m-%Y, %H:%i %p" ) AS fecha ,
        suplidor,
        OrderNumber,
        metPago
        FROM '.$this->table . '
        WHERE OrderNumber=?  ';
        //Prepare statement
        $stmt=$this->conn->prepare($query);
        //Bind param
        $stmt->bindParam(1, $this->OrderNumber);
        //Execute Statement
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        //Set properties
        $this->Id=$row['Id'];
        $this->usuario_registro=$row['usuario_registro'];
        $this->codigoCliente=$row['codigoCliente'];
        $this->tipoDocumento=$row['tipoDocumento'];
        $this->ncf=$row['ncf'];
        $this->referencia=$row['referencia'];
        $this->descuento=$row['descuento'];
        $this->totaln=$row['totaln'];
        $this->itbistot=$row['itbistot'];
        $this->detalle=$row['detalle'];
        $this->fecha=$row['fecha'];
        $this->suplidor=$row['suplidor'];
        $this->OrderNumber=$row['OrderNumber'];
        $this->metPago=$row['metPago'];
        $query= '
        SELECT
         p.Id AS idProducto,
         p.nombre,
         p.garantia,
         d.Id AS idDetalle,
         d.codigo_articulo,
         d.cantidad,
         d.precio,
         d.precio * d.cantidad As Total,
         d.idFactura,
         d.itbis,
         d.ref,
         d.Id AS IdDetalle,
         i.PrecioCompra,
         i.Ganancia,
         i.PrecioVenta as precioV,
         d.IdInventario
         FROM 
         producto p 
         INNER JOIN 
         detalle_factura d 
         ON 
         p.Id = d.codigo_articulo
         INNER JOIN
         factura f
         ON
         f.OrderNumber=d.idFactura
         LEFT JOIN 
         inventario i
         ON
         f.OrderNumber= i.IdFactura
         WHERE d.idFactura=? ';
         $stmt=$this->conn->prepare($query);
         //Bind param
         $stmt->bindParam(1, $this->OrderNumber);
         //Execute Statement
         $stmt->execute();
        return $stmt;
    }
}

        


