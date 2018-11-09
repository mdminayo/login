<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author KAMILOHR
 */
class Usuario {

    //put your code here
    private $id;
    private $nombre;
    private $clave;
    private $email;
    private $estado;
    private $ididioma;
    private $genero;
    private $idtipousuario;
    private $fechanacimineto;
    private $procedencia;
    private $telefono;
    private $foto;
    private $nit;
    private $direccion;
    
                function __construct($campo, $valor) {
        if ($campo != null) {
            if (is_array($campo))
                $this->loadObjectVector($campo);
            else {

                $cadenaSQL = "select id,nombre,email,clave,estado,ididioma,genero,idtipousuario,fechanacimiento,procedencia,telefono,foto,nit,direccion from usuario "
                        . " where $campo='$valor'";

                $resultado = ConectorBD::ejecutarQuery($cadenaSQL, null);

                if (count($resultado) > 0)
                    $this->loadObjectVector($resultado[0]);
            }
        }
    }

    private function loadObjectVector($vector) {
        $this->id = $vector['id'];
        $this->nombre = $vector['nombre'];
        $this->email = $vector['email'];
        $this->clave = $vector['clave'];
        $this->estado = $vector['estado'];
        $this->ididioma = $vector['ididioma'];
        $this->genero = $vector['genero'];
        $this->idtipousuario = $vector['idtipousuario'];
        $this->fechanacimineto = $vector['fechanacimiento'];
        $this->procedencia = $vector['procedencia'];
        $this->telefono = $vector['telefono'];
        $this->foto = $vector['foto'];
        $this->nit = $vector['nit'];
        $this->direccion = $vector['direccion'];
    }
    function getIdtipousuario() {
        return $this->idtipousuario;
    }

    function setIdtipousuario($idtipousuario) {
        $this->idtipousuario = $idtipousuario;
    }

        function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getEmail() {
        return $this->email;
    }

    function getClave() {
        return $this->clave;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    public static function validate($user, $clave) {
        $valido = false;
        $usuario = new Usuario("email", $user);
        if ($usuario->getEmail() != null) {
            if ($usuario->getClave() == md5($clave))
                $valido = true;
        }
        return $valido;
    }

    public static function getMenu($tipo) {

        $lista = "<ul id='menu' >";

        if ($tipo == 1) {
            $lista .= "<li><a href='principal.php?CONTENIDO=inicio.php'>Incio</a></li>";
            $lista .= "<li><a href='principal.php?CONTENIDO=world/categoria.php'>Categoria</a></li>";
            $lista .= "<li><a href='principal.php?CONTENIDO=world/imagen.php'>Imagenes</a></li>";
            $lista .= "<li><a href='#'>Datos Personales</a></li>";
            $lista .= "<li><a href='index.php' >Salir</a></li>";
        } else if ($tipo == 2) {
            $lista .= "<li><a href='principal.php?CONTENIDO=inicio.php'>Incio</a></li>";
            $lista .= "<li><a href='#'>Eventos</a></li>";
            $lista .= "<li><a href='#'>Configuracion</a></li>";
            $lista .= "<li><a href='#'>Datos Personales</a></li>";
            $lista .= "<li><a href='index.php'>Salir</a></li>";
        }
        $lista .= "</ul>";


        return $lista;
    }

}
