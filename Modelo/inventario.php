<?php
class Inventario{
    //DB Properties
    private $conn;
    private $table='inventario';
    //Properties
          public $Id;
          public $IdProducto;
          public $PrecioCompra;
          public $Ganancia;
          public $PrecioVenta;
          public $Descuento;
          public $PorcientoDescuento;
          public $Cantidad;
          public $Fecha;
    public function __construct($db){
        $this->conn=$db;
    }
    public function read(){
        $query='SELECT p.Id, 
        p.nombre, 
        p.codigo_suplidor, 
        p.usuario_registro, 
        p.fecha_registro, 
        p.fecha_actualizacion,
         p.tipo_impuesto, 
         p.estado, 
         p.codigo_categoria, 
         p.referencia_interna, 
         p.referencia_suplidor, 
         p.foto, p.oferta, 
         p.modificar_precio, 
         p.acepta_descuento, 
         p.detalle, 
         p.codigo_marca, 
         p.porciento_beneficio, 
         p.porciento_minimo, 
         p.modelo, p.Codigo, 
         i.Id as IdInventario, 
         i.IdProducto, 
         i.PrecioCompra, 
         i.Ganancia, 
         i.PrecioVenta, 
         i.Descuento, 
         i.PorcientoDescuento, 
         i.Cantidad, 
         i.Fecha 
         FROM producto p 
         INNER JOIN 
         inventario i 
         ON 
         p.Id = i.IdProducto 
         WHERE i.Cantidad > 0 
         AND p.estado=1 ';
        //Prepare statement
        $stmt=$this->conn->prepare($query);
        //Execute query
        $stmt->execute();
        return $stmt;
    }
        
    
    
   

    
   
}