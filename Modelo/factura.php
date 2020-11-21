<?php
class Factura 
{
    private $conn;
    private $table='factura';
    private $table1='detalle_factura';
    /*--------------Factura--------------------*/ 
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
    /*--------------Detalle Factura--------------------*/ 
        public $codigo_articulo;
        public $cantidad ;
        public $precio ;
        public $idFactura;	 
        public $itbis;
        public $arreglo;
        public function __construct($db){
            $this->conn=$db;
        }

        public function create()
        {
            $query='INSERT INTO '.$this->table .'
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
            fecha = :fecha ';
             //Prepare staement
            $stmt=$this->conn->prepare($query);
            //Clean Data
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
            //Bind Data
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
            //Execute query
            if($stmt->execute())
            {
                return true;
            }
            printf("Error: %s.\n",$stmt->error);
            return false;
        }
        

        public function createDetails(){
            foreach ($arreglo as $row ) {
                $query='INSERT INTO '.$this->table1 .'
                SET 
                codigo_articulo = :codigo_articulo,
                cantidad = :cantidad,
                precio = :precio,
                idFactura = :idFactura,
                itbis = :itbis ';  
                
                $stmt=$this->conn->prepare($query);
                $this->codigo_articulo =htmlspecialchars(strip_tags($row['codigo_articulo']));  
                $this->cantidad =htmlspecialchars(strip_tags($row['cantidad']));
                $this->precio =htmlspecialchars(strip_tags($row['precio']));
                $this->idFactura =$this->referencia;
                $this->itbis =htmlspecialchars(strip_tags($row['itbis']));

                $stmt->bindParam(':codigo_articulo', $this->codigo_articulo);
                $stmt->bindParam(':cantidad', $this->cantidad);
                $stmt->bindParam(':precio', $this->precio);
                $stmt->bindParam(':idFactura', $this->idFactura);
                $stmt->bindParam(':itbis', $this->itbis);
                
                if($stmt->execute())
                {
                    return true;
                }
                printf("Error: %s.\n",$stmt->error);
                return false;
            }
        }


}

        


