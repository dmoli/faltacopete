<?php
    require_once '../DAL/connect_relacional.php';
    require_once '../DAL/usuario.php';
    require_once '../DAL/botilleria.php';
    
if(isset($_REQUEST['si-mayor']))
{
    $recordar = $_REQUEST['recordar'];
    if($recordar == 1){
       if(!isset($_COOKIE['edad'])){
           setcookie("edad", 'si', time() + (60 * 60 * 24 * 30 * 12), "/"); //un año   
       }
    }else{
        if(!isset($_COOKIE['edad-temporal'])){
            setcookie("edad-temporal", 'si', 0, "/"); //hasta q se cierre el navegador
        }
    }
}    
if(isset($_REQUEST['modificar-clave']))
{
    $botilleria = new botilleria();
    $clave = $_REQUEST['clave'];
//    $idBotilleria = $_SESSION['id_boti'];
    $idBotilleria = $_REQUEST['id_boti'];
    $re = $botilleria->cambiarClave($idBotilleria, $clave);
    echo $re;
}
if(isset($_REQUEST['comprobar-clave']))
{
    $botilleria = new botilleria();
    $claveActual = $_REQUEST['claveActual'];
//    $idBotilleria = $_SESSION['id_boti'];
    $idBotilleria = $_REQUEST['id_boti'];
    $re = $botilleria->comprobarClave($idBotilleria, $claveActual);  
    echo $re;
}
if(isset($_REQUEST['activar-cupon2']))
{
    $botilleria = new botilleria();
    $idOferta = $_REQUEST['idOferta'];
    //$idBotilleria = $_SESSION['id_boti'];
    $idBotilleria = $_REQUEST['id_boti'];
    
    $re = $botilleria->insertarSolicitud($idBotilleria, $idOferta);
    if($re == 1){
        $popup = '<div class="content-popup">';
                $popup.= '<h2 class="titulo-unpaso bold">Activar Oferta</h2>  
                                <div class="texto">
                                    !Muchas gracias!
                                    <br><br>
                                    Hemos recibido con éxito tu solicitud, en menos de 24 horas tu oferta estará activa en nuestro sitio web.
                                    Recibirás un e-mail con la URL de la oferta para que la puedas visualizar en nuestro sitio web,
                                    y recuerda los días de permanencia de la oferta corren a partir del momento que nuestro equipo
                                    la active.
                     
                                    <br><br>
                                    <label class="atte">Atte. El equipo de Faltacopete.cl <br> SUERTE!</label>
                                 
                                </div>';
                          $popup.='<div class="container">
                                    <input type="button"  class="btn btn-success btn-lg aceptar" value="Aceptar">
                                </div>
                              ';
         $popup.= '</div>';
    }else{
        $popup = '<div class="content-popup">';
                $popup.= '<h2 class="titulo-unpaso bold">Activar Oferta</h2>  
                                <div class="texto">
                                    <label class="atte">Error 334, actualice la página porfavor.</div>                               
                                </div>';
                          $popup.='<div class="container">
                                    <a href="http://www.faltacopete.cl/home-admin" class="btn btn-danger btn-lg">Actualizar página</a>
                                </div>
                              ';
         $popup.= '</div>';
    }
    echo $popup;
}
if(isset($_REQUEST['generar-cupon2']))
{
    $usuario = new usuario();
    $idUsuario = -1;
    $idOferta = $_REQUEST['idOferta'];
    $nombre = $_REQUEST['nombre'];
    $email = $_REQUEST['email'];
    $idComuna = $_REQUEST['comuna'];
    $usuariofound = $usuario->buscarPorMail($email);
    if($usuariofound != null)//Existe en la BD
    {
        $idUsuario = $usuariofound['id'];
    }else{//Guardar y sacar el id
        $idUsuario = $usuario->insertar($nombre, $email, $idComuna);
    }
    $idCupon = $usuario->generarCupon($idOferta, $idUsuario);
    $codigo = $usuario->generarCodigo($idCupon, $idUsuario);//se genera el cód para el usuario "1020" por ej
    $re = $usuario->editarCodigoCupon($idCupon, $codigo);
    $usuario->aumentarGenerado($idOferta);
    $re = array('re'=>$re,
                'id'=>$idCupon,
                'codigo'=>$codigo);
    echo json_encode($re);
}


?>