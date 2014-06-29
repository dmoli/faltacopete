<?php
function email($para, $asunto, $cuerpo){
	 $headers = "MIME-Version: 1.0\r\n"; 
	 $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        // $para = "sebastian.lagos@gmail.com";
	 $re =  mail($para,$asunto,$cuerpo,$headers); 
                mail('diego.jose.molina@live.com',$asunto,$cuerpo,$headers); 
         return $re;
}
if(isset($_REQUEST['recuperar-clave'])){
    require_once '../DAL/connect_relacional.php';
    require_once '../DAL/usuario.php';
    require_once '../DAL/botilleria.php';
    $usuario= $_REQUEST['usuario'];
    $botilleria = new botilleria();
    $botiFound = $botilleria->verPorEmailoUsuario($usuario);
    if($botiFound != null){
        $nuevaClave = $botilleria->recuperarClave($botiFound['id']);
        $para = $botiFound['email'];
        $cuerpo = recuperarClave($botiFound['nombre'], $nuevaClave);
        $re = email($para,  'Faltacopete.cl - Recuperar Clave',$cuerpo);
        if($re){
            echo json_encode(array('re'=>1, "email"=>$para));
        }else{
            echo json_encode(array('re'=>-2));
        }
    }else{
        echo json_encode(array('re'=>-1));
    }
}
if(isset($_REQUEST['mailBienvenida'])){
    $nombre = $_REQUEST['nombre'];
    $para = $_REQUEST['email'];
    $usuario = $_REQUEST['usuario'];
    $clave = 'abc123';
    $cuerpo = mailBienvenida($nombre, $usuario, $clave);
    $re = email($para,  'Faltacopete.cl - Bienvenido',$cuerpo);
    if($re)
        echo "si";
     else
       echo "no";
}
if(isset($_REQUEST['mailCupon'])){
    $nombre = $_REQUEST['nombre'];
    $codigo = $_REQUEST['codigo'];
    $idCupon = $_REQUEST['idCupon'];
    $para = $_REQUEST['para'];
    $cuerpo = mailCupon($nombre, $codigo, $idCupon);
        
    $re = email($para, utf8_decode('Faltacopete.cl - Cupón Generado'),$cuerpo);
    if($re)
        echo "si";
     else
       echo "no";
}
if(isset($_REQUEST['contacto'])){
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $fono = $_POST['fono'];
    $msj = $_POST['msj'];
    $cuerpo = contacto($nombre, $email, $fono, $msj);
    $para = 'diego.jose.molina@live.com';
    $re = email($para, utf8_decode('Faltacopete.cl - Consulta'),$cuerpo);
    if($re){
         $popup = '<div class="content-popup">';
                $popup.= '<h2 class="titulo-unpaso bold">Hemos recibido exitosamente tu mensaje :)</h2>  
                                <div class="texto">
                                    !Hola! muchas gracias por contactarnos, el equipo revisará inmediatamente
                                    tu mensaje y te responderemos a la brevedad.                     
                                    <br><br>
                                    <label class="atte">Atte. El equipo de Faltacopete.cl <br> SUERTE!</label>
                                 
                                </div>';
         $popup.= '</div>';
        echo json_encode(array("re"=>1,
                               "html"=>$popup));
    }else{
       $popup = '<div class="content-popup">';
                $popup.= '<h2 class="titulo-unpaso bold">Algo sucedió mal :(</h2>  
                                <div class="texto">
                                    !Hola! tu mensaje no pudo ser enviado, pero NO TE PREOCUPES :)
                                    contáctate directamente a este número <b>510 98 779</b> y nuestro
                                    equipo te ayudará en lo que necesites.
                                    <br><br>
                                    <label class="atte">Atte. El equipo de Faltacopete.cl <br> SUERTE!</label>
                                 
                                </div>';
         $popup.= '</div>';
       echo json_encode(array("re"=>-1,
                               "html"=>$popup));
    }
}

//Mail de bienvenida
function mailBienvenida($nombre, $usuario, $clave){
     $hora = getdate(time());
     if($hora["minutes"] < 10 && $hora["minutes"] != 0)
       $hora["minutes"] = "0".$hora["minutes"];

     $horaReal = $hora["hours"]. ":" . $hora["minutes"];
             
    $html = '<html><head></head><body><table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="ecxbodyTable" style="border-collapse:collapse;padding:0;background-color:#F2F2F2;height:100% !important;width:100% !important;">
                <tbody><tr>
                    <td align="center" valign="top" id="ecxbodyCell" style="border-collapse:collapse;padding:0;border-top:0;height:100% !important;width:100% !important;">
                        
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;">
                            <tbody>
                            <tr>
                                <td align="center" valign="top" style="border-collapse:collapse;">
                                    
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="ecxtemplateHeader" style="border-collapse:collapse;background-color:#FFFFFF;border-top:0;border-bottom:0;">
                                        <tbody><tr>
                                            <td align="center" valign="top" style="border-collapse:collapse;">
                                                <table border="0" cellpadding="0" cellspacing="0" width="600" class="ecxtemplateContainer" style="border-collapse:collapse;">
                                                    <tbody><tr>
                                                        <td valign="top" class="ecxheaderContainer" style="padding-top:10px;padding-right:18px;padding-bottom:10px;padding-left:18px;border-collapse:collapse;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnImageBlock" style="border-collapse:collapse;">
    <tbody class="ecxmcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding:9px;border-collapse:collapse;" class="ecxmcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="ecxmcnImageContentContainer" style="border-collapse:collapse;">
                        <tbody><tr>
                            <td class="ecxmcnImageContent" valign="top" style="padding-right:9px;padding-left:9px;padding-top: 0px;padding-bottom:0;border-collapse:collapse;">

                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table></td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top" style="border-collapse:collapse;">
                                    
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="ecxtemplateBody" style="border-collapse:collapse;background-color:#FFFFFF;border-top:0;border-bottom:0;">
                                        <tbody><tr>
                                            <td align="center" valign="top" style="border-collapse:collapse;">
                                                <table border="0" cellpadding="0" cellspacing="0" width="600" class="ecxtemplateContainer" style="border-collapse:collapse;">
                                                    <tbody><tr>
                                                        <td valign="top" class="ecxbodyContainer" style="padding-top:10px;padding-right:18px;padding-bottom:10px;padding-left:18px;border-collapse:collapse;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnTextBlock" style="border-collapse:collapse;">
    <tbody class="ecxmcnTextBlockOuter">
        <tr>
            <td valign="top" class="ecxmcnTextBlockInner" style="border-collapse:collapse;">

                <table align="left" border="0" cellpadding="0" cellspacing="0" width="600" class="ecxmcnTextContentContainer" style="border-collapse:collapse;">
                    <tbody><tr>

                        <td valign="top" class="ecxmcnTextContent" style="padding-top:9px;padding-right:18px;padding-bottom:9px;padding-left:18px;border-collapse:collapse;color:#606060;font-family:Helvetica;font-size:15px;line-height:150%;text-align:left;">

 
 <h1 style="display:block;font-family: Helvetica;font-size: 24px;font-style:normal;
            font-weight:bold;line-height:125%;letter-spacing: -1px;text-align:left;color: #3165BD;">
            Bienvenido a FALTACOPETE.CL!.
</h1>
<br><b>HOLA :) '.$nombre.':</b><br>
<br>Te damos la bienvenida a nuestra página web,
<br>para poder ingresar a tu cuenta y crear una oferta ingresa con los siguientes datos:<br>
<br>Usuario: <b>'.$usuario.'</b>
<br>Clave: <b>'.$clave.'</b><br>
Por seguridad, recuerda cambiar la clave inmediatamente en el menu de opciones.
<br><b>Atte. El equipo de Faltacopete.cl</b><br><br>
<a style="text-decoration: none;
margin: 12px 1px 0px 193px;
font-size: 15px;
display: block;
width: 143px;
border-radius: 2px;
text-align: center;
float: left;
padding: 12px 14px;
text-shadow: 0 1px 2px rgba(0,0,0,0.25);
background: rgba(41, 134, 33, 1);
color: #FFF;"
href="http://www.faltacopete.cl/login">Comenzar</a>

                        </td>
                    </tr>
                </tbody></table>

            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnDividerBlock" style="border-collapse:collapse;">
    <tbody class="ecxmcnDividerBlockOuter">
        <tr>
            <td class="ecxmcnDividerBlockInner" style="padding:18px;border-collapse:collapse;">
                <table class="ecxmcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-top-width:1px;border-top-style:solid;border-top-color: rgba(21, 58, 138, 0.36);border-collapse:collapse;">
                    <tbody><tr>
                        
                    </tr>
                </tbody></table>
            </td>
        </tr>
    </tbody>
</table> 
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnFollowBlock" style="border-collapse:collapse;">
    <tbody class="ecxmcnFollowBlockOuter">
        <tr>
            <td align="center" valign="top" style="padding:9px;border-collapse:collapse;" class="ecxmcnFollowBlockInner">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnFollowContentContainer" style="border-collapse:collapse;">
    <tbody><tr>
        <td align="center" style="padding-left:9px;padding-right:9px;border-collapse:collapse;">
            <table border="0" cellpadding="0" cellspacing="0" class="ecxmcnFollowContent" style="border-collapse:collapse;">
                <tbody><tr>
                    <td valign="top" style="padding-top:9px;padding-right:9px;padding-left:9px;border-collapse:collapse;display: none;">



                                <table align="left" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                                    <tbody><tr>
                                        <td valign="top" style="padding-right:10px;padding-bottom:9px;border-collapse:collapse;" class="ecxmcnFollowContentItemContainer">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnFollowContentItem" style="border-collapse:collapse;">
                                                <tbody><tr>
                                                    <td align="left" valign="middle" style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px;border-collapse:collapse;">
                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse:collapse;">
                                                            <tbody><tr>

                                                                    <td align="center" valign="middle" width="18" class="ecxmcnFollowIconContent" style="border-collapse:collapse;">
                                                                    </td>


                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        </td>
                                    </tr>
                                </tbody></table>




                                <table align="left" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                                    <tbody><tr>
                                        <td valign="top" style="padding-right:10px;padding-bottom:9px;border-collapse:collapse;" class="ecxmcnFollowContentItemContainer">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnFollowContentItem" style="border-collapse:collapse;">
                                                <tbody><tr>
                                                    <td align="left" valign="middle" style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px;border-collapse:collapse;">
                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse:collapse;">
                                                            <tbody><tr>

                                                                    <td align="center" valign="middle" width="18" class="ecxmcnFollowIconContent" style="border-collapse:collapse;">
                                                                    </td>


                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        </td>
                                    </tr>
                                </tbody></table>




                                <table align="left" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                                    <tbody><tr>
                                        <td valign="top" style="padding-right:0;padding-bottom:9px;border-collapse:collapse;" class="ecxmcnFollowContentItemContainer">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnFollowContentItem" style="border-collapse:collapse;">
                                                <tbody><tr>
                                                    <td align="left" valign="middle" style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px;border-collapse:collapse;">
                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse:collapse;">
                                                            <tbody><tr>

                                                                    <td align="center" valign="middle" width="18" class="ecxmcnFollowIconContent" style="border-collapse:collapse;">
                                                                    </td>


                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        </td>
                                    </tr>
                                </tbody></table>


                    </td>
                </tr>
            </tbody></table>
        </td>
    </tr>
</tbody></table>

            </td>
        </tr>
    </tbody>
</table></td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top" style="border-collapse:collapse;">
                                    
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="ecxtemplateFooter" style="border-collapse:collapse;background-color: #124191;border-top:0;border-bottom:0;">
                                        <tbody><tr>
                                            <td align="center" valign="top" style="border-collapse:collapse;">
                                                <table border="0" cellpadding="0" cellspacing="0" width="600" class="ecxtemplateContainer" style="border-collapse:collapse;">
                                                    <tbody><tr>
                                                        <td valign="top" class="ecxfooterContainer" style="padding-top:10px;padding-right:18px;padding-bottom:10px;padding-left:18px;border-collapse:collapse;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnTextBlock" style="border-collapse:collapse;">
    <tbody class="ecxmcnTextBlockOuter">
        <tr>
            <td valign="top" class="ecxmcnTextBlockInner" style="border-collapse:collapse;">

                <table align="left" border="0" cellpadding="0" cellspacing="0" width="600" class="ecxmcnTextContentContainer" style="border-collapse:collapse;">
                    <tbody><tr>

                        <td valign="top" class="ecxmcnTextContent" style="padding-top:9px;padding-right:18px;padding-bottom:9px;padding-left:18px;border-collapse:collapse;color: #fff;font-family:Helvetica;font-size:11px;line-height:125%;text-align:left;">

                            <em>Copyright © '.date('Y').' Falta copete, All rights reserved.</em><br>
                            <em>Enviado a las '.$horaReal.' hrs.</em>
<br>
<br>
<br>
&nbsp;&nbsp;&nbsp; &nbsp;<br>
<br>
<br>

                        </td>
                    </tr>
                </tbody></table>

            </td>
        </tr>
    </tbody>
</table></td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                        </tbody></table>
                        
                    </td>
                </tr>
            </tbody></table></body></html>';
    return utf8_decode($html);

}

//Mail de cupon
function mailCupon($nombre, $codigo, $idCupon){
     $hora = getdate(time());
     if($hora["minutes"] < 10 && $hora["minutes"] != 0)
       $hora["minutes"] = "0".$hora["minutes"];

     $horaReal = $hora["hours"]. ":" . $hora["minutes"];
             
    $html = '<html><head></head><body><table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="ecxbodyTable" style="border-collapse:collapse;padding:0;background-color:#F2F2F2;height:100% !important;width:100% !important;">
                <tbody><tr>
                    <td align="center" valign="top" id="ecxbodyCell" style="border-collapse:collapse;padding:0;border-top:0;height:100% !important;width:100% !important;">
                        
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;">
                            <tbody>
                            <tr>
                                <td align="center" valign="top" style="border-collapse:collapse;">
                                    
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="ecxtemplateHeader" style="border-collapse:collapse;background-color:#FFFFFF;border-top:0;border-bottom:0;">
                                        <tbody><tr>
                                            <td align="center" valign="top" style="border-collapse:collapse;">
                                                <table border="0" cellpadding="0" cellspacing="0" width="600" class="ecxtemplateContainer" style="border-collapse:collapse;">
                                                    <tbody><tr>
                                                        <td valign="top" class="ecxheaderContainer" style="padding-top:10px;padding-right:18px;padding-bottom:10px;padding-left:18px;border-collapse:collapse;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnImageBlock" style="border-collapse:collapse;">
    <tbody class="ecxmcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding:9px;border-collapse:collapse;" class="ecxmcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="ecxmcnImageContentContainer" style="border-collapse:collapse;">
                        <tbody><tr>
                            <td class="ecxmcnImageContent" valign="top" style="padding-right:9px;padding-left:9px;padding-top: 0px;padding-bottom:0;border-collapse:collapse;">

                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table></td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top" style="border-collapse:collapse;">
                                    
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="ecxtemplateBody" style="border-collapse:collapse;background-color:#FFFFFF;border-top:0;border-bottom:0;">
                                        <tbody><tr>
                                            <td align="center" valign="top" style="border-collapse:collapse;">
                                                <table border="0" cellpadding="0" cellspacing="0" width="600" class="ecxtemplateContainer" style="border-collapse:collapse;">
                                                    <tbody><tr>
                                                        <td valign="top" class="ecxbodyContainer" style="padding-top:10px;padding-right:18px;padding-bottom:10px;padding-left:18px;border-collapse:collapse;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnTextBlock" style="border-collapse:collapse;">
    <tbody class="ecxmcnTextBlockOuter">
        <tr>
            <td valign="top" class="ecxmcnTextBlockInner" style="border-collapse:collapse;">

                <table align="left" border="0" cellpadding="0" cellspacing="0" width="600" class="ecxmcnTextContentContainer" style="border-collapse:collapse;">
                    <tbody><tr>

                        <td valign="top" class="ecxmcnTextContent" style="padding-top:9px;padding-right:18px;padding-bottom:9px;padding-left:18px;border-collapse:collapse;color:#606060;font-family:Helvetica;font-size:15px;line-height:150%;text-align:left;">

 
                            <h1 style="display:block;font-family: Helvetica;font-size: 24px;font-style:normal;font-weight:bold;line-height:125%;letter-spacing: -1px;text-align:left;color: #3165BD;">Nuevo cupón generado.</h1>
<br><b>FELICITACIONES :) '.$nombre.':</b><br>
<br>Acabas de generar el cupón, para canjearlo sólo debes 
<br>ir a la botillería, mencionar nuestra página y el código <b>'.$codigo.'</b><br>
<br>Ingresa al siguiente link para ver la información completa del cupón.<br><br>

<a style="text-decoration: none;
margin: 12px 1px 0px 193px;
font-size: 15px;
display: block;
width: 143px;
border-radius: 2px;
text-align: center;
float: left;
padding: 12px 14px;
text-shadow: 0 1px 2px rgba(0,0,0,0.25);
background: rgba(41, 134, 33, 1);
color: #FFF;"
href="http://www.faltacopete.cl/cupon/'.$idCupon.'">Ver detalle del cupón</a>
<br>Muchas gracias, distruta de todos los descuentos!<br>
<br><b>Atte. El equipo de Faltacopete.cl</b><br><br>

                        </td>
                    </tr>
                </tbody></table>

            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnDividerBlock" style="border-collapse:collapse;">
    <tbody class="ecxmcnDividerBlockOuter">
        <tr>
            <td class="ecxmcnDividerBlockInner" style="padding:18px;border-collapse:collapse;">
                <table class="ecxmcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-top-width:1px;border-top-style:solid;border-top-color: rgba(21, 58, 138, 0.36);border-collapse:collapse;">
                    <tbody><tr>
                        
                    </tr>
                </tbody></table>
            </td>
        </tr>
    </tbody>
</table> 
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnFollowBlock" style="border-collapse:collapse;">
    <tbody class="ecxmcnFollowBlockOuter">
        <tr>
            <td align="center" valign="top" style="padding:9px;border-collapse:collapse;" class="ecxmcnFollowBlockInner">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnFollowContentContainer" style="border-collapse:collapse;">
    <tbody><tr>
        <td align="center" style="padding-left:9px;padding-right:9px;border-collapse:collapse;">
            <table border="0" cellpadding="0" cellspacing="0" class="ecxmcnFollowContent" style="border-collapse:collapse;">
                <tbody><tr>
                    <td valign="top" style="padding-top:9px;padding-right:9px;padding-left:9px;border-collapse:collapse;display: none;">



                                <table align="left" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                                    <tbody><tr>
                                        <td valign="top" style="padding-right:10px;padding-bottom:9px;border-collapse:collapse;" class="ecxmcnFollowContentItemContainer">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnFollowContentItem" style="border-collapse:collapse;">
                                                <tbody><tr>
                                                    <td align="left" valign="middle" style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px;border-collapse:collapse;">
                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse:collapse;">
                                                            <tbody><tr>

                                                                    <td align="center" valign="middle" width="18" class="ecxmcnFollowIconContent" style="border-collapse:collapse;">
                                                                    </td>


                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        </td>
                                    </tr>
                                </tbody></table>




                                <table align="left" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                                    <tbody><tr>
                                        <td valign="top" style="padding-right:10px;padding-bottom:9px;border-collapse:collapse;" class="ecxmcnFollowContentItemContainer">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnFollowContentItem" style="border-collapse:collapse;">
                                                <tbody><tr>
                                                    <td align="left" valign="middle" style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px;border-collapse:collapse;">
                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse:collapse;">
                                                            <tbody><tr>

                                                                    <td align="center" valign="middle" width="18" class="ecxmcnFollowIconContent" style="border-collapse:collapse;">
                                                                    </td>


                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        </td>
                                    </tr>
                                </tbody></table>




                                <table align="left" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                                    <tbody><tr>
                                        <td valign="top" style="padding-right:0;padding-bottom:9px;border-collapse:collapse;" class="ecxmcnFollowContentItemContainer">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnFollowContentItem" style="border-collapse:collapse;">
                                                <tbody><tr>
                                                    <td align="left" valign="middle" style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px;border-collapse:collapse;">
                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse:collapse;">
                                                            <tbody><tr>

                                                                    <td align="center" valign="middle" width="18" class="ecxmcnFollowIconContent" style="border-collapse:collapse;">
                                                                    </td>


                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        </td>
                                    </tr>
                                </tbody></table>


                    </td>
                </tr>
            </tbody></table>
        </td>
    </tr>
</tbody></table>

            </td>
        </tr>
    </tbody>
</table></td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top" style="border-collapse:collapse;">
                                    
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="ecxtemplateFooter" style="border-collapse:collapse;background-color: #124191;border-top:0;border-bottom:0;">
                                        <tbody><tr>
                                            <td align="center" valign="top" style="border-collapse:collapse;">
                                                <table border="0" cellpadding="0" cellspacing="0" width="600" class="ecxtemplateContainer" style="border-collapse:collapse;">
                                                    <tbody><tr>
                                                        <td valign="top" class="ecxfooterContainer" style="padding-top:10px;padding-right:18px;padding-bottom:10px;padding-left:18px;border-collapse:collapse;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnTextBlock" style="border-collapse:collapse;">
    <tbody class="ecxmcnTextBlockOuter">
        <tr>
            <td valign="top" class="ecxmcnTextBlockInner" style="border-collapse:collapse;">

                <table align="left" border="0" cellpadding="0" cellspacing="0" width="600" class="ecxmcnTextContentContainer" style="border-collapse:collapse;">
                    <tbody><tr>

                        <td valign="top" class="ecxmcnTextContent" style="padding-top:9px;padding-right:18px;padding-bottom:9px;padding-left:18px;border-collapse:collapse;color: #fff;font-family:Helvetica;font-size:11px;line-height:125%;text-align:left;">

                            <em>Copyright © '.date('Y').' Falta copete, All rights reserved.</em><br>
                            <em>Enviado a las '.$horaReal.' hrs.</em>
<br>
<br>
<br>
&nbsp;&nbsp;&nbsp; &nbsp;<br>
<br>
<br>

                        </td>
                    </tr>
                </tbody></table>

            </td>
        </tr>
    </tbody>
</table></td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                        </tbody></table>
                        
                    </td>
                </tr>
            </tbody></table></body></html>';
    return utf8_decode($html);
}

//Mail recuperar clave
function recuperarClave($nombre, $clave){
     $hora = getdate(time());
     if($hora["minutes"] < 10 && $hora["minutes"] != 0)
       $hora["minutes"] = "0".$hora["minutes"];

     $horaReal = $hora["hours"]. ":" . $hora["minutes"];
             
    $html = '<html><head></head><body><table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="ecxbodyTable" style="border-collapse:collapse;padding:0;background-color:#F2F2F2;height:100% !important;width:100% !important;">
                <tbody><tr>
                    <td align="center" valign="top" id="ecxbodyCell" style="border-collapse:collapse;padding:0;border-top:0;height:100% !important;width:100% !important;">
                        
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;">
                            <tbody>
                            <tr>
                                <td align="center" valign="top" style="border-collapse:collapse;">
                                    
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="ecxtemplateHeader" style="border-collapse:collapse;background-color:#FFFFFF;border-top:0;border-bottom:0;">
                                        <tbody><tr>
                                            <td align="center" valign="top" style="border-collapse:collapse;">
                                                <table border="0" cellpadding="0" cellspacing="0" width="600" class="ecxtemplateContainer" style="border-collapse:collapse;">
                                                    <tbody><tr>
                                                        <td valign="top" class="ecxheaderContainer" style="padding-top:10px;padding-right:18px;padding-bottom:10px;padding-left:18px;border-collapse:collapse;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnImageBlock" style="border-collapse:collapse;">
    <tbody class="ecxmcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding:9px;border-collapse:collapse;" class="ecxmcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="ecxmcnImageContentContainer" style="border-collapse:collapse;">
                        <tbody><tr>
                            <td class="ecxmcnImageContent" valign="top" style="padding-right:9px;padding-left:9px;padding-top: 0px;padding-bottom:0;border-collapse:collapse;">

                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table></td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top" style="border-collapse:collapse;">
                                    
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="ecxtemplateBody" style="border-collapse:collapse;background-color:#FFFFFF;border-top:0;border-bottom:0;">
                                        <tbody><tr>
                                            <td align="center" valign="top" style="border-collapse:collapse;">
                                                <table border="0" cellpadding="0" cellspacing="0" width="600" class="ecxtemplateContainer" style="border-collapse:collapse;">
                                                    <tbody><tr>
                                                        <td valign="top" class="ecxbodyContainer" style="padding-top:10px;padding-right:18px;padding-bottom:10px;padding-left:18px;border-collapse:collapse;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnTextBlock" style="border-collapse:collapse;">
    <tbody class="ecxmcnTextBlockOuter">
        <tr>
            <td valign="top" class="ecxmcnTextBlockInner" style="border-collapse:collapse;">

                <table align="left" border="0" cellpadding="0" cellspacing="0" width="600" class="ecxmcnTextContentContainer" style="border-collapse:collapse;">
                    <tbody><tr>

                        <td valign="top" class="ecxmcnTextContent" style="padding-top:9px;padding-right:18px;padding-bottom:9px;padding-left:18px;border-collapse:collapse;color:#606060;font-family:Helvetica;font-size:15px;line-height:150%;text-align:left;">

 
                            <h1 style="display:block;font-family: Helvetica;font-size: 24px;font-style:normal;font-weight:bold;line-height:125%;letter-spacing: -1px;text-align:left;color: #3165BD;">Recuperar clave</h1>
<br><b>'.$nombre.':</b><br>
<br>Tu nueva clave es <b>'.$clave.'</b><br>
<br>Copia la nueva clave e ingresa al panel de administración, por seguridad anda al menú de opciones y cambiala inmediatamente.<br>
<br>
<b>Atte. El equipo de Faltacopete.cl <br> SUERTE!</b><br>
<br>
<br>
<a style="text-decoration: none;
margin: 12px 1px 0px 193px;
font-size: 15px;
display: block;
width: 143px;
border-radius: 2px;
text-align: center;
float: left;
padding: 8px 14px;
text-shadow: 0 1px 2px rgba(0,0,0,0.25);
background-repeat: repeat-x;
border: 1px solid rgba(65, 115, 169, 0.34);
border: 1px solid rgba(65, 169, 94, 0);
background: rgba(48, 160, 38, 1);
background: -webkit-linear-gradient(top,rgba(118, 194, 47, 1), rgba(48, 160, 38, 1));
color: #FFF;
border: 1px solid rgba(48, 156, 39, 1);
border-top-color: rgba(77, 184, 67, 1);
border-bottom-color: rgba(41, 134, 33, 1);"
href="http://www.faltacopete.cl/login">INGRESA A LA PÁGINA AQUÍ</a>
                        </td>
                    </tr>
                </tbody></table>

            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnDividerBlock" style="border-collapse:collapse;">
    <tbody class="ecxmcnDividerBlockOuter">
        <tr>
            <td class="ecxmcnDividerBlockInner" style="padding:18px;border-collapse:collapse;">
                <table class="ecxmcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-top-width:1px;border-top-style:solid;border-top-color: rgba(21, 58, 138, 0.36);border-collapse:collapse;">
                    <tbody><tr>
                        
                    </tr>
                </tbody></table>
            </td>
        </tr>
    </tbody>
</table> 
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnFollowBlock" style="border-collapse:collapse;">
    <tbody class="ecxmcnFollowBlockOuter">
        <tr>
            <td align="center" valign="top" style="padding:9px;border-collapse:collapse;" class="ecxmcnFollowBlockInner">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnFollowContentContainer" style="border-collapse:collapse;">
    <tbody><tr>
        <td align="center" style="padding-left:9px;padding-right:9px;border-collapse:collapse;">
            <table border="0" cellpadding="0" cellspacing="0" class="ecxmcnFollowContent" style="border-collapse:collapse;">
                <tbody><tr>
                    <td valign="top" style="padding-top:9px;padding-right:9px;padding-left:9px;border-collapse:collapse;display: none;">



                                <table align="left" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                                    <tbody><tr>
                                        <td valign="top" style="padding-right:10px;padding-bottom:9px;border-collapse:collapse;" class="ecxmcnFollowContentItemContainer">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnFollowContentItem" style="border-collapse:collapse;">
                                                <tbody><tr>
                                                    <td align="left" valign="middle" style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px;border-collapse:collapse;">
                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse:collapse;">
                                                            <tbody><tr>

                                                                    <td align="center" valign="middle" width="18" class="ecxmcnFollowIconContent" style="border-collapse:collapse;">
                                                                    </td>


                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        </td>
                                    </tr>
                                </tbody></table>




                                <table align="left" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                                    <tbody><tr>
                                        <td valign="top" style="padding-right:10px;padding-bottom:9px;border-collapse:collapse;" class="ecxmcnFollowContentItemContainer">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnFollowContentItem" style="border-collapse:collapse;">
                                                <tbody><tr>
                                                    <td align="left" valign="middle" style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px;border-collapse:collapse;">
                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse:collapse;">
                                                            <tbody><tr>

                                                                    <td align="center" valign="middle" width="18" class="ecxmcnFollowIconContent" style="border-collapse:collapse;">
                                                                    </td>


                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        </td>
                                    </tr>
                                </tbody></table>




                                <table align="left" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                                    <tbody><tr>
                                        <td valign="top" style="padding-right:0;padding-bottom:9px;border-collapse:collapse;" class="ecxmcnFollowContentItemContainer">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnFollowContentItem" style="border-collapse:collapse;">
                                                <tbody><tr>
                                                    <td align="left" valign="middle" style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px;border-collapse:collapse;">
                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse:collapse;">
                                                            <tbody><tr>

                                                                    <td align="center" valign="middle" width="18" class="ecxmcnFollowIconContent" style="border-collapse:collapse;">
                                                                    </td>


                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        </td>
                                    </tr>
                                </tbody></table>


                    </td>
                </tr>
            </tbody></table>
        </td>
    </tr>
</tbody></table>

            </td>
        </tr>
    </tbody>
</table></td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top" style="border-collapse:collapse;">
                                    
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="ecxtemplateFooter" style="border-collapse:collapse;background-color: #124191;border-top:0;border-bottom:0;">
                                        <tbody><tr>
                                            <td align="center" valign="top" style="border-collapse:collapse;">
                                                <table border="0" cellpadding="0" cellspacing="0" width="600" class="ecxtemplateContainer" style="border-collapse:collapse;">
                                                    <tbody><tr>
                                                        <td valign="top" class="ecxfooterContainer" style="padding-top:10px;padding-right:18px;padding-bottom:10px;padding-left:18px;border-collapse:collapse;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnTextBlock" style="border-collapse:collapse;">
    <tbody class="ecxmcnTextBlockOuter">
        <tr>
            <td valign="top" class="ecxmcnTextBlockInner" style="border-collapse:collapse;">

                <table align="left" border="0" cellpadding="0" cellspacing="0" width="600" class="ecxmcnTextContentContainer" style="border-collapse:collapse;">
                    <tbody><tr>

                        <td valign="top" class="ecxmcnTextContent" style="padding-top:9px;padding-right:18px;padding-bottom:9px;padding-left:18px;border-collapse:collapse;color: #fff;font-family:Helvetica;font-size:11px;line-height:125%;text-align:left;">

                            <em>Copyright © '.date('Y').' Falta copete, All rights reserved.</em><br>
                            <em>Enviado a las '.$horaReal.' hrs.</em>
<br>
<br>
<br>
&nbsp;&nbsp;&nbsp; &nbsp;<br>
<br>
<br>

                        </td>
                    </tr>
                </tbody></table>

            </td>
        </tr>
    </tbody>
</table></td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                        </tbody></table>
                        
                    </td>
                </tr>
            </tbody></table></body></html>';
    return utf8_decode($html);
}

//contacto admin
function contacto($nombre, $email, $fono, $msj){
     $hora = getdate(time());
     if($hora["minutes"] < 10 && $hora["minutes"] != 0)
       $hora["minutes"] = "0".$hora["minutes"];

     $horaReal = $hora["hours"]. ":" . $hora["minutes"];
             
    $html = '<html><head></head><body><table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="ecxbodyTable" style="border-collapse:collapse;padding:0;background-color:#F2F2F2;height:100% !important;width:100% !important;">
                <tbody><tr>
                    <td align="center" valign="top" id="ecxbodyCell" style="border-collapse:collapse;padding:0;border-top:0;height:100% !important;width:100% !important;">
                        
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;">
                            <tbody>
                            <tr>
                                <td align="center" valign="top" style="border-collapse:collapse;">
                                    
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="ecxtemplateHeader" style="border-collapse:collapse;background-color:#FFFFFF;border-top:0;border-bottom:0;">
                                        <tbody><tr>
                                            <td align="center" valign="top" style="border-collapse:collapse;">
                                                <table border="0" cellpadding="0" cellspacing="0" width="600" class="ecxtemplateContainer" style="border-collapse:collapse;">
                                                    <tbody><tr>
                                                        <td valign="top" class="ecxheaderContainer" style="padding-top:10px;padding-right:18px;padding-bottom:10px;padding-left:18px;border-collapse:collapse;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnImageBlock" style="border-collapse:collapse;">
    <tbody class="ecxmcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding:9px;border-collapse:collapse;" class="ecxmcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="ecxmcnImageContentContainer" style="border-collapse:collapse;">
                        <tbody><tr>
                            <td class="ecxmcnImageContent" valign="top" style="padding-right:9px;padding-left:9px;padding-top: 0px;padding-bottom:0;border-collapse:collapse;">

                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table></td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top" style="border-collapse:collapse;">
                                    
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="ecxtemplateBody" style="border-collapse:collapse;background-color:#FFFFFF;border-top:0;border-bottom:0;">
                                        <tbody><tr>
                                            <td align="center" valign="top" style="border-collapse:collapse;">
                                                <table border="0" cellpadding="0" cellspacing="0" width="600" class="ecxtemplateContainer" style="border-collapse:collapse;">
                                                    <tbody><tr>
                                                        <td valign="top" class="ecxbodyContainer" style="padding-top:10px;padding-right:18px;padding-bottom:10px;padding-left:18px;border-collapse:collapse;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnTextBlock" style="border-collapse:collapse;">
    <tbody class="ecxmcnTextBlockOuter">
        <tr>
            <td valign="top" class="ecxmcnTextBlockInner" style="border-collapse:collapse;">

                <table align="left" border="0" cellpadding="0" cellspacing="0" width="600" class="ecxmcnTextContentContainer" style="border-collapse:collapse;">
                    <tbody><tr>

                        <td valign="top" class="ecxmcnTextContent" style="padding-top:9px;padding-right:18px;padding-bottom:9px;padding-left:18px;border-collapse:collapse;color:#606060;font-family:Helvetica;font-size:15px;line-height:150%;text-align:left;">

 
                            <h1 style="display:block;font-family: Helvetica;font-size: 24px;font-style:normal;font-weight:bold;line-height:125%;letter-spacing: -1px;text-align:left;color: #3165BD;">Nueva consulta!.</h1>
<br><b>Administrador:</b><br> 
<br>Acaban de consultar desde la página:
<br>Nombre: <b>'.$nombre.'</b><br>
<br>E-mail: <b>'.$email.'</b><br>
<br>Fono: <b>'.$fono.'</b><br>
<br>Mensaje: <br>
        '.$msj.'<br>
<br><b>Atte. tu mismo</b><br><br>

                        </td>
                    </tr>
                </tbody></table>

            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnDividerBlock" style="border-collapse:collapse;">
    <tbody class="ecxmcnDividerBlockOuter">
        <tr>
            <td class="ecxmcnDividerBlockInner" style="padding:18px;border-collapse:collapse;">
                <table class="ecxmcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-top-width:1px;border-top-style:solid;border-top-color: rgba(21, 58, 138, 0.36);border-collapse:collapse;">
                    <tbody><tr>
                        
                    </tr>
                </tbody></table>
            </td>
        </tr>
    </tbody>
</table> 
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnFollowBlock" style="border-collapse:collapse;">
    <tbody class="ecxmcnFollowBlockOuter">
        <tr>
            <td align="center" valign="top" style="padding:9px;border-collapse:collapse;" class="ecxmcnFollowBlockInner">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnFollowContentContainer" style="border-collapse:collapse;">
    <tbody><tr>
        <td align="center" style="padding-left:9px;padding-right:9px;border-collapse:collapse;">
            <table border="0" cellpadding="0" cellspacing="0" class="ecxmcnFollowContent" style="border-collapse:collapse;">
                <tbody><tr>
                    <td valign="top" style="padding-top:9px;padding-right:9px;padding-left:9px;border-collapse:collapse;display: none;">



                                <table align="left" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                                    <tbody><tr>
                                        <td valign="top" style="padding-right:10px;padding-bottom:9px;border-collapse:collapse;" class="ecxmcnFollowContentItemContainer">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnFollowContentItem" style="border-collapse:collapse;">
                                                <tbody><tr>
                                                    <td align="left" valign="middle" style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px;border-collapse:collapse;">
                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse:collapse;">
                                                            <tbody><tr>

                                                                    <td align="center" valign="middle" width="18" class="ecxmcnFollowIconContent" style="border-collapse:collapse;">
                                                                    </td>


                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        </td>
                                    </tr>
                                </tbody></table>




                                <table align="left" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                                    <tbody><tr>
                                        <td valign="top" style="padding-right:10px;padding-bottom:9px;border-collapse:collapse;" class="ecxmcnFollowContentItemContainer">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnFollowContentItem" style="border-collapse:collapse;">
                                                <tbody><tr>
                                                    <td align="left" valign="middle" style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px;border-collapse:collapse;">
                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse:collapse;">
                                                            <tbody><tr>

                                                                    <td align="center" valign="middle" width="18" class="ecxmcnFollowIconContent" style="border-collapse:collapse;">
                                                                    </td>


                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        </td>
                                    </tr>
                                </tbody></table>




                                <table align="left" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                                    <tbody><tr>
                                        <td valign="top" style="padding-right:0;padding-bottom:9px;border-collapse:collapse;" class="ecxmcnFollowContentItemContainer">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnFollowContentItem" style="border-collapse:collapse;">
                                                <tbody><tr>
                                                    <td align="left" valign="middle" style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px;border-collapse:collapse;">
                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse:collapse;">
                                                            <tbody><tr>

                                                                    <td align="center" valign="middle" width="18" class="ecxmcnFollowIconContent" style="border-collapse:collapse;">
                                                                    </td>


                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        </td>
                                    </tr>
                                </tbody></table>


                    </td>
                </tr>
            </tbody></table>
        </td>
    </tr>
</tbody></table>

            </td>
        </tr>
    </tbody>
</table></td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top" style="border-collapse:collapse;">
                                    
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="ecxtemplateFooter" style="border-collapse:collapse;background-color: #124191;border-top:0;border-bottom:0;">
                                        <tbody><tr>
                                            <td align="center" valign="top" style="border-collapse:collapse;">
                                                <table border="0" cellpadding="0" cellspacing="0" width="600" class="ecxtemplateContainer" style="border-collapse:collapse;">
                                                    <tbody><tr>
                                                        <td valign="top" class="ecxfooterContainer" style="padding-top:10px;padding-right:18px;padding-bottom:10px;padding-left:18px;border-collapse:collapse;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="ecxmcnTextBlock" style="border-collapse:collapse;">
    <tbody class="ecxmcnTextBlockOuter">
        <tr>
            <td valign="top" class="ecxmcnTextBlockInner" style="border-collapse:collapse;">

                <table align="left" border="0" cellpadding="0" cellspacing="0" width="600" class="ecxmcnTextContentContainer" style="border-collapse:collapse;">
                    <tbody><tr>

                        <td valign="top" class="ecxmcnTextContent" style="padding-top:9px;padding-right:18px;padding-bottom:9px;padding-left:18px;border-collapse:collapse;color: #fff;font-family:Helvetica;font-size:11px;line-height:125%;text-align:left;">

                            <em>Copyright © '.date('Y').' Falta copete, All rights reserved.</em><br>
                            <em>Enviado a las '.$horaReal.' hrs.</em>
<br>
<br>
<br>
&nbsp;&nbsp;&nbsp; &nbsp;<br>
<br>
<br>

                        </td>
                    </tr>
                </tbody></table>

            </td>
        </tr>
    </tbody>
</table></td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                        </tbody></table>
                        
                    </td>
                </tr>
            </tbody></table></body></html>';
    return utf8_decode($html);
}
?>
