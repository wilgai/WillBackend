<?php
class Producto{
    //DB Properties
    private $conn;
    private $table='producto';
    //Properties
          public $nombre;
          public $codigo_suplidor;
          public $usuario_registro;
          public $fecha_registro;
          public $fecha_actualizacion;
          public $tipo_impuesto;
          public $estado;
          public $codigo_subcategoria;
          public $referencia_interna;
          public $referencia_suplidor;
          public $foto;
          public $oferta;
          public $modificar_precio;
          public $acepta_descuento;
          public $detalle;
          public $codigo_marca;
          public $porciento_beneficio;
          public $porciento_minimo;
          public $modelo;
          public $codigo;
    public function __construct($db){
        $this->conn=$db;
    }

    public function create()
    {
        $query='INSERT INTO '.$this->table .'
        SET 
        nombre = :nombre,
        codigo_suplidor = :codigo_suplidor,
        usuario_registro = :usuario_registro,
        fecha_registro = :fecha_registro,
        fecha_actualizacion = :fecha_actualizacion,
        tipo_impuesto = :tipo_impuesto ,
        estado = :estado ,
        codigo_subcategoria = :codigo_subcategoria,
        referencia_interna = :referencia_interna ,
        referencia_suplidor = :referencia_suplidor, 
        foto = :foto,
        oferta = :oferta,
        modificar_precio = :modificar_precio,
        acepta_descuento = :acepta_descuento,
        detalle = :detalle,
        codigo_marca = :codigo_marca ,
        porciento_beneficio = :porciento_beneficio ,
        porciento_minimo = :porciento_minimo,
        modelo = :modelo,
        codigo = :codigo ';


         //Prepare staement
        $stmt=$this->conn->prepare($query);

        //Clean Data
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->codigo_suplidor = htmlspecialchars(strip_tags($this->codigo_suplidor));
        $this->usuario_registro = htmlspecialchars(strip_tags($this->usuario_registro));
        $this->fecha_registro = htmlspecialchars(strip_tags($this->fecha_registro));
        $this->fecha_actualizacion = htmlspecialchars(strip_tags($this->fecha_actualizacion));
        $this->tipo_impuesto = htmlspecialchars(strip_tags($this->tipo_impuesto));
        $this->codigo_subcategoria = htmlspecialchars(strip_tags($this->codigo_subcategoria));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->referencia_interna = htmlspecialchars(strip_tags($this->referencia_interna));
        $this->referencia_suplidor = htmlspecialchars(strip_tags($this->referencia_suplidor));
        $this->foto = htmlspecialchars(strip_tags($this->foto));
        $this->oferta = htmlspecialchars(strip_tags($this->oferta));
        $this->modificar_precio = htmlspecialchars(strip_tags($this->modificar_precio));
        $this->acepta_descuento = htmlspecialchars(strip_tags($this->acepta_descuento));
        $this->detalle = htmlspecialchars(strip_tags($this->detalle));
        $this->codigo_marca = htmlspecialchars(strip_tags($this->codigo_marca));
        $this->porciento_beneficio = htmlspecialchars(strip_tags($this->porciento_beneficio));
        $this->porciento_minimo = htmlspecialchars(strip_tags($this->porciento_minimo));
        $this->modelo = htmlspecialchars(strip_tags($this->modelo));
        $this->codigo = htmlspecialchars(strip_tags($this->codigo));
        //Bind Data
       
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':codigo_suplidor', $this->codigo_suplidor);
        $stmt->bindParam(':usuario_registro', $this->usuario_registro);
        $stmt->bindParam(':fecha_registro', $this->fecha_registro);
        $stmt->bindParam(':fecha_actualizacion', $this->fecha_actualizacion);
        $stmt->bindParam(':tipo_impuesto', $this->tipo_impuesto);
        $stmt->bindParam(':codigo_subcategoria', $this->codigo_subcategoria);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':referencia_interna', $this->referencia_interna);
        $stmt->bindParam(':referencia_suplidor', $this->referencia_suplidor);
        $stmt->bindParam(':foto', $this->foto);
        $stmt->bindParam(':oferta', $this->oferta);
        $stmt->bindParam(':modificar_precio', $this->modificar_precio);
        $stmt->bindParam(':acepta_descuento', $this->acepta_descuento);
        $stmt->bindParam(':detalle', $this->detalle);
        $stmt->bindParam(':codigo_marca', $this->codigo_marca);
        $stmt->bindParam(':porciento_beneficio', $this->porciento_beneficio);
        $stmt->bindParam(':porciento_minimo', $this->porciento_minimo);
        $stmt->bindParam(':modelo', $this->modelo);
        $stmt->bindParam(':codigo', $this->codigo);
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
        $this->codigo_suplidor=$row['codigo_suplidor'];
        $this->usuario_registro=$row['usuario_registro'];
        $this->fecha_registro=$row['fecha_registro'];
        $this->fecha_actualizacion=$row['fecha_actualizacion'];
        $this->estado=$row['estado'];
        $this->tipo_impuesto=$row['tipo_impuesto'];
        $this->estado=$row['estado'];
        $this->codigo_subcategoria=$row['codigo_subcategoria'];
        $this->referencia_interna=$row['referencia_interna'];
        $this->referencia_suplidor=$row['referencia_suplidor'];
        $this->foto=$row['foto'];
        $this->oferta=$row['oferta'];
        $this->modificar_precio=$row['modificar_precio'];
        $this->coracepta_descuentoreo=$row['acepta_descuento'];
        $this->detalle=$row['detalle'];
        $this->codigo_marca=$row['codigo_marca'];
        $this->porciento_beneficio=$row['porciento_beneficio'];
        $this->porciento_minimo=$row['porciento_minimo'];
        $this->modelo=$row['modelo'];
        $this->codigo=$row['Codigo'];
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

    public  function CheckCode()
    {
        $query= ' SELECT *FROM '.$this->table . ' WHERE codigo=? ';
        //Prepare statement
        $stmt=$this->conn->prepare($query);
        //Bind param
        $stmt->bindParam(1, $this->codigo);
        //Execute Statement
        $stmt->execute();
        return $stmt;
    }

    public function update()
    {
        $query=' UPDATE '.$this->table .'
        SET 
        nombre = :nombre,
        codigo_suplidor = :codigo_suplidor,
        usuario_registro = :usuario_registro,
        fecha_registro = :fecha_registro,
        fecha_actualizacion = :fecha_actualizacion,
        tipo_impuesto = :tipo_impuesto ,
        estado = :estado ,
        codigo_subcategoria = :codigo_subcategoria,
        referencia_interna = :referencia_interna ,
        referencia_suplidor = :referencia_suplidor 
        foto = :foto,
        oferta = :oferta,
        modificar_precio = :modificar_precio,
        acepta_descuento = :acepta_descuento,
        detalle = :detalle,
        codigo_marca = :codigo_marca ,
        porciento_beneficio = :porciento_beneficio ,
        porciento_minimo = :porciento_minimo,
        modelo = :modelo,
        codigo = :codigo ';
        $stmt=$this->conn->prepare($query);
        //Clean Data
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->codigo_suplidor = htmlspecialchars(strip_tags($this->codigo_suplidor));
        $this->usuario_registro = htmlspecialchars(strip_tags($this->usuario_registro));
        $this->fecha_registro = htmlspecialchars(strip_tags($this->fecha_registro));
        $this->fecha_actualizacion = htmlspecialchars(strip_tags($this->fecha_actualizacion));
        $this->tipo_impuesto = htmlspecialchars(strip_tags($this->tipo_impuesto));
        $this->codigo_subcategoria = htmlspecialchars(strip_tags($this->codigo_subcategoria));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->referencia_interna = htmlspecialchars(strip_tags($this->referencia_interna));
        $this->referencia_suplidor = htmlspecialchars(strip_tags($this->referencia_suplidor));
        $this->foto = htmlspecialchars(strip_tags($this->foto));
        $this->oferta = htmlspecialchars(strip_tags($this->oferta));
        $this->modificar_precio = htmlspecialchars(strip_tags($this->modificar_precio));
        $this->acepta_descuento = htmlspecialchars(strip_tags($this->acepta_descuento));
        $this->detalle = htmlspecialchars(strip_tags($this->detalle));
        $this->codigo_marca = htmlspecialchars(strip_tags($this->codigo_marca));
        $this->porciento_beneficio = htmlspecialchars(strip_tags($this->porciento_beneficio));
        $this->porciento_minimo = htmlspecialchars(strip_tags($this->porciento_minimo));
        $this->modelo = htmlspecialchars(strip_tags($this->modelo));
        $this->codigo = htmlspecialchars(strip_tags($this->codigo));
        //Bind Data
       
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':codigo_suplidor', $this->codigo_suplidor);
        $stmt->bindParam(':usuario_registro', $this->usuario_registro);
        $stmt->bindParam(':fecha_registro', $this->fecha_registro);
        $stmt->bindParam(':fecha_actualizacion', $this->fecha_actualizacion);
        $stmt->bindParam(':tipo_impuesto', $this->tipo_impuesto);
        $stmt->bindParam(':codigo_subcategoria', $this->codigo_subcategoria);
        $stmt->bindParam(':contrasena', $this->contrasena);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':referencia_interna', $this->referencia_interna);
        $stmt->bindParam(':referencia_suplidor', $this->referencia_suplidor);
        $stmt->bindParam(':foto', $this->foto);
        $stmt->bindParam(':oferta', $this->oferta);
        $stmt->bindParam(':modificar_precio', $this->modificar_precio);
        $stmt->bindParam(':acepta_descuento', $this->acepta_descuento);
        $stmt->bindParam(':detalle', $this->detalle);
        $stmt->bindParam(':codigo_marca', $this->codigo_marca);
        $stmt->bindParam(':porciento_beneficio', $this->porciento_beneficio);
        $stmt->bindParam(':porciento_minimo', $this->porciento_minimo);
        $stmt->bindParam(':modelo', $this->modelo);
        $stmt->bindParam(':codigo', $this->codigo);
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