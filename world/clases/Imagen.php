<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Imagen
 *
 * @author gemelos
 */
class Imagen {
    private $id;
    private $archivo;
    private $descripcion;
    private $idevento;
    
    function __construct($campo,$valor) {
    if ($campo!=null){
        if (is_array($campo))$this->cargarObjetosEnVector($campo);
        else{
            $cadenaSQL="select id, archivo, descripcion, idevento from recurso where $campo=$valor";
            $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
            if (count($resultado)>0) $this->cargarObjetosEnVector($resultado[0]);
    }
    
        }
    }
    private function cargarObjetosEnVector($vector){
        $this->id=$vector['id'];
        $this->archivo=$vector['archivo'];    
        $this->descripcion=$vector['descripcion'];    
        $this->idevento=$vector['idevento'];    
    }
    
    function getId() {
        return $this->id;
    }

    function getArchivo() {
        return $this->archivo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getIdevento() {
        return $this->idevento;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setArchivo($archivo) {
        $this->archivo = $archivo;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setIdevento($idevento) {
        $this->idevento = $idevento;
    }

    public function grabar(){
        $cadenaSQL="insert into recurso(archivo, descripcion, idevento)values('{$this->archivo}','{$this->descripcion}',{$this->idevento})";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public function modificar(){
        $cadenaSQL="update recurso set archivo='{$this->archivo}', descripcion='{$this->descripcion}', idevento={$this->idevento} where id={$this->id}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public function eliminar(){
        $cadenaSQL="delete from recurso where id={$this->id}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatos($filtro, $orden){
        $cadenaSQL="select id, archivo, descripcion, idevento from recurso";
        if($filtro!=null)$cadenaSQL.= " where $filtro ";
        if($orden!=null)$cadenaSQL.= " order by $orden ";
        return ConectorBD::ejecutarQuery($cadenaSQL, NULL);
    }
    
    public static function getDatosEnObjetos($filtro, $orden){
        $datos= Imagen::getDatos($filtro, $orden);
        $listaImagen=array();
        for ($i = 0; $i < count($datos); $i++) {
            $imagen=new Imagen($datos[$i], null);
            $listaImagen[$i]=$imagen;
        }
        return $listaImagen;
    }
    
    public static function getGuardarIdEvento(){
        
    }
    
}
