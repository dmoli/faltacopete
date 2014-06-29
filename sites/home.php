<?php
    $botilleria = new botilleria();
    $ofertaVigentes = $botilleria->verOfertasVigentes();
    if(isset($_REQUEST['sector']) != ''){//comunas
            $sector = $botilleria->verComunaPorId($_REQUEST['sector']);
            $ofertaVigentes = $botilleria->buscadorPorComuna($_REQUEST['sector']);
            if(count($ofertaVigentes) == 1){
               $html = '<div class="msj1">'.count($ofertaVigentes).' Cupón gratis en</div> <b>'.$sector['nombre'].'!</b>';
            }elseif(count($ofertaVigentes) == 0){
               $html = '<div class="msj1">No hay cupones gratis en</div> <b>'.$sector['nombre'].'!</b>';
            }else{
                $html = '<div class="msj1">'.count($ofertaVigentes).' Cupones gratis en</div> <b>'.$sector['nombre'].'!</b>';
 
            }    
    }elseif(isset($_REQUEST['q']) != ''){
            $q = str_replace('-', ' ', $_REQUEST['q']);
            $ofertaVigentes = $botilleria->buscador($q);
             if(count($ofertaVigentes) == 1){
                 $html = '<div class="msj1">'.count($ofertaVigentes).' Resultado de:</div> <b>'.$q.'</b>';
             }elseif(count($ofertaVigentes) == 0){
                 $html = '<div class="msj1">Aún no hay resultados de:</div> <b>'.$q.'</b>';
             }else{
                 $html = '<div class="msj1">'.count($ofertaVigentes).' Resultados de:</div> <b>'.$q.'</b>';
             }
    }else{
            if(count($ofertaVigentes) == 1){
                 $html = '<div class="msj1">'.count($ofertaVigentes).' Cupón gratis en</div><b>SANTIAGO!</b>';
            }elseif(count($ofertaVigentes) == 0){
                 $html = '<div class="msj1">No hay cupones gratis en</div><b>SANTIAGO!</b>'; 
            }else{
                 $html = '<div class="msj1">'.count($ofertaVigentes).' Cupones gratis en</div><b>SANTIAGO!</b>'; 
            }
    }
?>
<div <?= $page_class ?>>
      <div class="row">
          <div class="mensaje-busqueda-home">
              <h2 id="sector-actual" class="titulo-pagina"><?= $html ?> 
                  <a href="#" class="sprites arrow"></a>
              </h2>
              <?php include_once('sites/secciones/sectores.php'); ?>
          </div>
        <?php
        if(count($ofertaVigentes) == 0){ 
            if(isset($_REQUEST['sector']) != ''){//comunas?>
                <div class="col-md-4">
                    <div class="mensaje-busqueda">Aún no tenemos cupones de descuento en <b><?= $sector['nombre']?></b>, 
                        Hazte FAN de nuestro Facebook para enterarte de cuando lleguen los
                        cupones de descuento a TU COMUNA! :)</div>
                    <div class="face-page">
                        <div class="fb-like-box" data-href="https://www.facebook.com/faltacopetechile" 
                             data-width="600" data-colorscheme="light" data-show-faces="true" 
                             data-header="true" data-stream="false" data-show-border="true"></div>
                    </div>
                    <div class="mensaje-botilleria">
                        <h2 class="titulo-pagina">¿Eres un local de bebidas alchólicas?</h2>
                         <div class="mensaje-busqueda">
                             Si quieres publicar tus ofertas y que sean vistas por muchas personas,
                             registrarte con nosotros en el formulario de abajo y te contactaremos inmediatamente!
                         </div>
                          <h2>Contacto:</h2>
                             <div class="form-contacto">
                                    <div class="form-group item-input2">
                                         <label for="nombre">Nombre*</label>
                                          <input name="nombre-botilleria" type="text" 
                                                 class=" form-control requerido" id="nombre-contacto"
                                                 placeholder="Introduce tu nombre aquí" required="true">
                                           <label class="mensaje-error error-nombre2">* Campo requerido</label>
                                     </div>
                                     <div class="form-group item-input2">
                                         <label for="email">E-mail*</label>
                                          <input  name="usuario-botilleria" type="text" 
                                                 class=" form-control requerido" id="email-contacto"
                                                 placeholder="Introduce tu email aquí" required="true">
                                           <label class="mensaje-error error-nombre2">* Campo requerido</label>
                                     </div>
                                    <div class="form-group item-input2">
                                         <label for="celular">Celular</label>
                                          <input  name="email-botilleria" type="text" 
                                                 class=" form-control requerido" id="celu-contacto"
                                                 placeholder="Introduce tu celular aquí" required="true">
                                           <label class="mensaje-error error-nombre2">* Campo requerido</label>
                                     </div>
                                     <div class="form-group item-input2">
                                         <label for="mensaje">Mensaje *</label>
                                          <textarea  name="horario-botilleria" id="mensaje-contacto" class="form-control requerido" 
                                           required="true" rows="5"></textarea>
                                     </div>
                                     <div class="form-group item-input2">
                                           <input value="Enviar" type="submit" name="editarBoti" id="enviar-contacto" class="btn btn-success btn-lg" role="button">
                                     </div>
                             </div><!-- contacto -->
                    </div>
                </div>
          <?php }else{//resultado de busqueda?>
                <div class="col-md-4">
                    <div class="mensaje-busqueda">Aún no tenemos cupones de descuento con relación a <b><?= $q?></b>, 
                        Hazte FAN de nuestro Facebook para enterarte de cuando lleguen los
                        cupones de descuento relacionados a  <b><?= $q?></b> :)</div>
                    <div class="face-page">
                        <div class="fb-like-box" data-href="https://www.facebook.com/faltacopetechile" 
                             data-width="600" data-colorscheme="light" data-show-faces="true" 
                             data-header="true" data-stream="false" data-show-border="true"></div>
                    </div>
                    <div class="mensaje-botilleria">
                        <h2 class="titulo-pagina">¿Eres una botillería?</h2>
                         <div class="mensaje-busqueda">
                             Si quieres publicar tus ofertas y que sean vistas por muchas personas,
                             registrarte con nosotros en el formulario de abajo y te contactaremos inmediatamente!
                         </div>
                          <h2>Contacto:</h2>
                             <div class="form-contacto">
                                    <div class="form-group item-input2">
                                         <label for="nombre">Nombre*</label>
                                          <input name="nombre-botilleria" type="text" 
                                                 class=" form-control requerido" id="nombre-contacto"
                                                 placeholder="Introduce tu nombre aquí" required="true">
                                           <label class="mensaje-error error-nombre2">* Campo requerido</label>
                                     </div>
                                     <div class="form-group item-input2">
                                         <label for="email">E-mail*</label>
                                          <input  name="usuario-botilleria" type="text" 
                                                 class=" form-control requerido" id="email-contacto"
                                                 placeholder="Introduce tu email aquí" required="true">
                                           <label class="mensaje-error error-nombre2">* Campo requerido</label>
                                     </div>
                                    <div class="form-group item-input2">
                                         <label for="celular">Celular</label>
                                          <input  name="email-botilleria" type="text" 
                                                 class=" form-control requerido" id="celu-contacto"
                                                 placeholder="Introduce tu celular aquí" required="true">
                                           <label class="mensaje-error error-nombre2">* Campo requerido</label>
                                     </div>
                                     <div class="form-group item-input2">
                                         <label for="mensaje">Mensaje *</label>
                                          <textarea  name="horario-botilleria" id="mensaje-contacto" class="form-control requerido" 
                                           required="true" rows="5"></textarea>
                                     </div>
                                     <div class="form-group item-input2">
                                           <input value="Enviar" type="submit" name="editarBoti" id="enviar-contacto" class="btn btn-success btn-lg" role="button">
                                     </div>
                             </div><!-- contacto -->
                             <div class="mensaje-contacto">
                                <div class="texto"> 
                                      Si tienes alguna duda o consulta no dudes en enviarnos un mensaje, 
                                      lo revisaremos y te responderemos a la brevedad.
                                </div>
                                <br><br>
                                <label class="atte">Atte. El equipo de Faltacopete.cl <br> SUERTE!</label>
                            </div>
                    </div>
                </div>
          <?php }
          }else
           foreach ($ofertaVigentes as $item){?>
                    <div class="col-md-4 ">
                        <a  href="/cupon/<?= $item['id']?>">
                            
                            <div style="background: url(http://www.faltacopete.cl/images/ofertas/<?= $item['foto']?>);
                                  background-size: cover; background-repeat: no-repeat" 
                                 id="vistaPrevia" class="nueva-foto img-oferta img-thumbnail border"></div>
                        </a>
                       
                     <div class="part-izq">
                            <h2 class="nom-oferta">
                                <label><?= ucfirst($item['nombre'])?></label>  
                                <?= ucfirst($item['nombre2'])?>
                            </h2>
                            <p class="desc-oferta"><?= $item['texto']?></p>
                            <div class="precio-oferta">
                                      <div class="precio-desc label-red">$<?= $item['precio_oferta']?></div>
                                      <div class="precio-real">Precio real: <label>$<?= $item['precio_real']?></label></div> 
                            </div>
                            <a href="/cupon/<?= $item['id']?>" id="ver-cupon" class="btn btn-danger btn-lg" role="button">!Ver cupón! »</a>
                            <div class="info-oferta">
                                <?php 
                                  //cuando pague
                              //   $diasRestantes = $botilleria->dateDiff($botilleria->hoy(), $item['fecha_caducidad']);
                                 $diasRestantes = $botilleria->VerVigenciaOfertasGratis($item['id_boti']);
                                ?>
                                <div class="generado-por">Generado por: <label><?= $item['cant_generado'] + 2 * 3?> personas</label></div>
                                <div class="expira-en">Este cupón expira en: <label><?=$diasRestantes?> días</label></div>
                                <div class="face-cupon">
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
                    </div>

          <?php }?>
      </div>
     
     
</div>