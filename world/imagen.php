


<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) .'/../clases/ConectorBD.php';
require_once dirname(__FILE__).'/clases/Imagen.php';
$datos= Imagen::getDatosEnObjetos(null, 'id'); 

$lista='';
for ($i = 0; $i < count($datos); $i++) { 
    $objeto=$datos[$i];
    $lista.="<div class='card' style='width: 18rem;'>";
    $extension= explode(".", $objeto->getArchivo());
    
    $auxiliar="";
    if ($extension[1]=="png" || $extension[1]=="jpg"){
        $auxiliar.="<img src='{$objeto->getArchivo()}' class='card-img-top tamanoMultimedia' alt='Card image cap'/>";
    }else if ($extension[1]=="mp4"){
        $auxiliar.="<video src='{$objeto->getArchivo()}' controls='controls' class='card-img-top tamanoMultimedia' alt='Card image cap'></video>";
    }else{
        $auxiliar="error";
    }
    $lista.="$auxiliar";
    $lista.="<div class='card-body'> ";
    $lista.="<h5>{$objeto->getIdevento()}</h5>";
    $lista.="<p>{$objeto->getDescripcion()}</p>";
    $lista.="</div> ";
    
    $lista.="<div style='padding: 20px'>";
    $lista.="<a style='margin-left: 40%' class='card-link' href='principal.php?CONTENIDO=world/imagenFormulario.php&accion=Modificar&id={$objeto->getId()}'><img src='presentacion/imagenes/modificar.png' title='Modificar'></a>";
    $lista.="<a class='card-link' href='#'><img src='presentacion/imagenes/eliminar.png' title='Eliminar' onClick='eliminar({$objeto->getId()});'/></a>";
    $lista.='</div>';
    
    
    $lista.='</div>';
    
}


?>

<h3 class="display-4 text-center">LISTA DE IMAGENES</h3>

<div class="container">
    <div class="card-columns">
        <?=$lista?>
    </div>
</div>


<div id="modalSelectMultimedia">
    <img onclick="cerrarModal()" src="presentacion/imagenes/error.png" style="float: right; cursor: pointer">
    <div id="containerSectM" class="container">
        <h3 class="text-center">QUE DESEA SUBIR?</h3>
        <div id="options" >
            
            <div class="card" style='width: 300px;'> 
                <img onclick="adicionar('f')" class='card-img-top tamanoMultimedia' title="Imagen" style="cursor: pointer" alt='Card image cap' src="presentacion/naturaleza.jpg" alt=""/>
                <div class="card-body">
                    <h3>Imagen</h3>
                </div>
            </div>
            
            <div class="card" style='width: 300px'> 
                <img onclick="adicionar('t')" class='card-img-top tamanoMultimedia' title="Video" style="cursor: pointer" alt='Card image cap' src="presentacion/img.jpg" alt=""/>
                <div class="card-body">
                    <h3>Video</h3>
                </div>
            </div>            
                      
        </div>
        
        <br>
    </div>
</div>

<script type="text/javascript">
    function eliminar(id){
        if(confirm('Realmente desea eliminar este registro?')) 
            location='principal.php?CONTENIDO=world/imagenActualizar.php&accion=Eliminar&id='+id;   
    }
    boton();
    function boton(){
        var pantalla="<?= $_GET['CONTENIDO'] ?>";
        if(pantalla==='world/imagen.php'){
            $('.actual').html("<a class='btn btn-primary' style='color: white' href='#' onclick='modalOpen()'>Adicionar</a>");
        }
    }
    function cerrarModal(){
        $("#modalSelectMultimedia").fadeOut();//ocultamos el modal
    }
    
    function modalOpen(){
        $("#modalSelectMultimedia").fadeIn();
    }
    
    function adicionar(opcion){
        if(opcion=="f"){
            location="principal.php?CONTENIDO=world/imagenFormulario.php&accion=Adicionar&tipo=F";
        }else{
            location="principal.php?CONTENIDO=world/imagenFormulario.php&accion=Adicionar&tipo=V";
        }
    }
</script>

