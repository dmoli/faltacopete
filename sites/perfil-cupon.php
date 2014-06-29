<?php
    $botilleria = new botilleria();
    $id = $_REQUEST['id'];
    $item = $botilleria->verOfertaPorId($id);
?>
<div <?= $page_class ?>>
     
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
                <a data-idOferta="<?= $item['id'] ?>" id="generar-cupon" class="btn btn-danger btn-lg" href="#" role="button">Generar Gratis</a>
                <div class="info-oferta2">
                    <?php      
                      // $diasRestantes = $botilleria->dateDiff($botilleria->hoy(), $item['fecha_caducidad']);
                       $diasRestantes = $botilleria->VerVigenciaOfertasGratis($item['id_boti']);
                        $botilleria = $botilleria->verPorId($item['id_boti']);
                      ?>
                    <div class="generado-por2">Generado por: <label><?= $item['cant_generado'] + 2 * 3?> personas</label></div>
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
            <div class="tipo-img tipo-img-perfil">
                <?php if($item['tipo_imagen'] == 1){?>
                   <div class="option-img">
                     <label>* Imágen referencial</label>     
                   </div>
                <?php }else{?>
                   <div class="option-img">
                     <label>* Imágen 100% real</label>
                   </div>
               <?php }?>
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
                  <input id="lat" type="hidden" value="<?= $botilleria['lat']?>" />
                  <input id="lng" type="hidden" value="<?= $botilleria['lng']?>" />
                </div>
                <!--<h4 class="bold h-sinmarg info-cupon">¿Dónde queda la boti?</h4>-->
                <h2 class="nom-botilleria"><?=$botilleria['nombre']?></h2>
                <div style="background: url(images/botillerias/<?=$botilleria['foto']?>);
                                  background-size: cover; background-repeat: no-repeat" 
                                 id="vistaPrevia" class="img-botilleria img-thumbnail border"></div>
                <div class="descripcion-boti">                    
                    <div class="label-det">
                        <label class="sprites icon-dire"></label>
                        <?=$botilleria['direccion']?>
                    </div>
                    <?php if($botilleria['telefono1'] != ''){?>
                        <div class="label-det">
                             <label class="sprites icon-tel"></label>
                            <?=$botilleria['telefono1']?> 
                                <?php if($botilleria['telefono2'] != ''){?>
                                    - <?=$botilleria['telefono2']?>
                                <?php }?>
                        </div>
                    <?php }?>
                    <div id="horario-bot" class="label-det horarios">
                           <label class="sprites icon-hora"></label>
                            <?=$botilleria['horario']?>
                    </div>
<!--                    <a id="ver-comentarios" href="#" class="btn btn-success btn-lg">Ver comentarios</a>-->
                </div>
       </div>
       <input id="titulo-face" type="hidden" value="<?= ucfirst($item['nombre']).' '.ucfirst($item['nombre2'])?>"/>
       <input id="link-face" type="hidden" value="http://faltacopete.cl/cupon/<?= $item['id']?>"/>
       <input id="foto-face" type="hidden" value="http://www.faltacopete.cl/images/ofertas/<?= $item['foto']?>"/>
       
       <input id="fb-logged" type="hidden" value="0"/>
       <input id="nombrefb" type="hidden" />
       <input id="emailfb" type="hidden" />
       <input id="fotofb" type="hidden" />
   </div>
     
     
</div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="/js/maps.js"></script>
<script type="text/javascript" src="/js/face-script.js"></script>