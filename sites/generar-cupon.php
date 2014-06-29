<?php 
    require_once 'DAL/usuario.php';
    require_once 'DAL/botilleria.php';
    require_once 'function/send.php';
    $botilleria = new botilleria();
    $usuario = new usuario();
    $idcupon = $_REQUEST['id'];
    $cuponGenerado = $usuario->verCuponGenerado($idcupon);
    if($cuponGenerado == null){//si no existe
        header("location:http://www.faltacopete.cl/home");
    }
    $item = $botilleria->verOfertaPorId($cuponGenerado['id_oferta']);
    $usuarioQueGenero = $usuario->buscarPorId($cuponGenerado['id_usuario']);
    $botilleriaFound = $botilleria->verPorId($item['id_boti']); 
    
    //guardar un carro de cupones
        $_SESSION['link-cupon'] = 'http://www.faltacopete.cl/generar-cupon/'.$idcupon;
        $_SESSION['nombre-cupon'] = $item['nombre'].'...';
    //fin guardar carro de cupones
?>
<div <?= $page_class ?>>
     
      <div class="row">
        <div class="col-md-4">
            <h2 class="info-generar h-sinmarg">
                <label class="green">FELICITACIONES :)</label>
            </h2>
            <div class="info-generar container desc-generarcupon">
             Acabas de generar el cupón, para canjearlo sólo debes 
                    ir a la <b>"<?= $botilleriaFound['nombre']?>"</b>, mencionar nuestra página y el código <b><?= $cuponGenerado['codigo']?></b>
                    <br>
                    Te hemos enviado un correo electrónico a <b><?= $usuarioQueGenero['email']?></b> para que veas nuevamente la información completa del cupón.
                    <br>
                    <div class="consejos">
                        <label>* No olvides revisar tu carpeta de spam por si acaso :)</label>
                        <label>* Sácale una foto al código para que no se te olvide ;) </label>
                        <label>* Más abajo está la dirección del local ;)</label>
                    </div>
            </div>
            
        </div>
     </div>
     <div class="row">
        <div class="col-md-4 primera-parte">
          <a  href="#"> 
              <div style="background: url(http://www.faltacopete.cl/images/ofertas/<?= $item['foto']?>);
                                  background-size: cover; background-repeat: no-repeat" 
                                 id="vistaPrevia" class="nueva-foto2 img-oferta img-thumbnail border"></div>
         </a>
            <div class="part-izq">
                <h2 class="nom-oferta2">
                    <label><?= ucfirst($item['nombre'])?></label>  
                           <?= ucfirst($item['nombre2'])?>
                </h2>
                <!--<p class="desc-oferta"></p>-->
                <div class="precio-oferta2">
                          <div class="precio-desc2 label-red">$<?= $item['precio_oferta']?></div>
                          <div class="precio-real2">Precio real: <label>$<?= $item['precio_real']?></label></div> 
                </div>
                <div class="info-oferta2">
                    <?php      
                      // $diasRestantes = $botilleria->dateDiff($botilleria->hoy(), $item['fecha_caducidad']);
                       $diasRestantes = $botilleria->VerVigenciaOfertasGratis($item['id_boti']);
                      ?>
                    <div class="generado-por2">Generado por: <label><?= $item['cant_generado']+ 2 * 3?> personas</label></div>
                    <div class="expira-en2">Este cupón vence en: <label><?=$diasRestantes?> días</label></div>

                </div>
                <div class="face-cupon2">
                         <div  class="fb-like" 
                                          data-href="http://www.faltacopete.cl/cupon/<?= $item['id']?>" 
                                          data-width="300px" 
                                          data-layout="button_count" 
                                          data-action="like" 
                                          data-show-faces="true" 
                                          data-share="false"></div>
                 </div>
            </div>
        </div>

        <div class="bottom-perfil">
            <h2 class="bold h-sinmarg info-cupon">Información del cupón</h2>
                <div class="descripcion">
                    <h4>Detalles e información</h4>
                    <ul class="items">
                        <?= $item['detalles']?>
                    </ul>
                </div>
                <div class="condiciones">
                    <h4>Condiciones</h4>
                    <ul class="items">
                       <?php include_once('sites/secciones/condiciones.php');?>     
                        <?= $item['condiciones']?>
                    </ul>
                </div>
                
           
       </div>
        <div class="mapa-right">
                <div class="mapa-boti">
                     <div id='map_canvas' style='width: 100%;
                                        height: 100%;
                                        overflow: hidden;
                                        position: relative;
                                        border-radius: 5px;
                                        background-color: rgb(229, 227, 223);
                                        -webkit-transform: translateZ(0);'></div>
                  <input id="lat" type="hidden" value="<?= $botilleriaFound['lat']?>" />
                  <input id="lng" type="hidden" value="<?= $botilleriaFound['lng']?>" />
                </div>
                <!--<h4 class="bold h-sinmarg info-cupon">¿Dónde queda la boti?</h4>-->
                <h2 class="nom-botilleria"><?=$botilleriaFound['nombre']?></h2>
                <div style="background: url(images/botillerias/<?=$botilleriaFound['foto']?>);
                                  background-size: cover; background-repeat: no-repeat" 
                                 id="vistaPrevia" class="img-botilleria img-thumbnail border"></div>
                <div class="descripcion-boti">                    
                    <div class="label-det">
                        <label class="sprites icon-dire"></label>
                        <?=$botilleriaFound['direccion']?>
                    </div>
                    <?php if($botilleriaFound['telefono1'] != ''){?>
                        <div class="label-det">
                             <label class="sprites icon-tel"></label>
                            <?=$botilleriaFound['telefono1']?> 
                                <?php if($botilleriaFound['telefono2'] != ''){?>
                                    - <?=$botilleriaFound['telefono2']?>
                                <?php }?>
                        </div>
                    <?php }?>
                    <div id="horario-bot" class="label-det horarios">
                           <label class="sprites icon-hora"></label>
                            <?=$botilleriaFound['horario']?>
                    </div>
<!--                    <a id="ver-comentarios" href="#" class="btn btn-success btn-lg">Ver comentarios</a>-->
                </div>
       </div>
       
   </div>
     
     
</div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="/js/maps.js"></script>