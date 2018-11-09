<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Categoria
 *
 * @author gemelos
 */
class Categoria {
    private $id;
    private $nombre;
    private $descripcion;
    
    function __construct($campo,$valor) {
    if ($campo!=null){
        if (is_array($campo))$this->cargarObjetosEnVector($campo);
        else{
            $cadenaSQL="select id, nombre, descripcion from categoria where $campo=$valor";
            $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
            if (count($resultado)>0) $this->cargarObjetosEnVector($resultado[0]);
    }
    
        }
    }
    private function cargarObjetosEnVector($vector){
        $this->id=$vector['id'];
        $this->nombre=$vector['nombre'];    
        $this->descripcion=$vector['descripcion'];    
    }
    
    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

        
    public function grabar(){
        $cadenaSQL="insert into categoria(nombre, descripcion)values('{$this->nombre}','{$this->descripcion}')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public function modificar(){
        $cadenaSQL="update categoria set nombre='{$this->nombre}', descripcion='{$this->descripcion}' where id={$this->id}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from categoria where id={$this->id}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatos($filtro, $orden){
        $cadenaSQL="select id, nombre, descripcion from categoria";
        if($filtro!=null)$cadenaSQL.= " where $filtro ";
        if($orden!=null)$cadenaSQL.= " order by $orden ";
        return ConectorBD::ejecutarQuery($cadenaSQL, NULL);
    }
    
    public static function getDatosEnObjetos($filtro, $orden){
        $datos= Categoria::getDatos($filtro, $orden);
        $listaCategoria=array();
        for ($i = 0; $i < count($datos); $i++) {
            $categoria=new Categoria($datos[$i], null);
            $listaCategoria[$i]=$categoria;
        }
        return $listaCategoria;
    }


}
