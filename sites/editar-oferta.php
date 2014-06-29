<?php
     if(!isset($_SESSION["id_boti"])){
        header('location:http://www.faltacopete.cl/login');
    }else{
        //calcular el tiempo transcurrido
        $fechaguardada = $_SESSION["ultimoAcceso"];
        $ahora = time();
        $duracion = $ahora - $fechaguardada; //tiempo transcurrido en segundos
        $tiempoTranscurrido =  (int)$duracion/3600; //en hora /3600
        if($tiempoTranscurrido >= 1) //si es una hora y más lo echa
        {
           session_destroy();
           header('location:http://www.faltacopete.cl/login');//si es exitoso al index
        }
        else{
             $_SESSION["ultimoAcceso"] = time();
        }
    }
    $botilleria = new botilleria();
    $oferta = $botilleria->verOfertaPorId($_REQUEST['id']);
?>
<form id="formulario2" name="formulario2" method="POST" action="http://www.faltacopete.cl/function/upload-oferta.php" enctype="multipart/form-data">   
<div <?= $page_class ?>>
     
      <div class="row">
       <div class="col-md-4">
            
       </div>
           <div class="col-md-4 content-input-oferta primera-parte">
               <h2 class="titulo-editar">Edita información de tu oferta: </h2>
               <div style="background-image: url(http://www.faltacopete.cl/images/ofertas/<?= $oferta['foto']?>)" id="vistaPrevia" 
                    class="nueva-foto2 img-oferta img-thumbnail">
                   <label class="label-img">Haz click aquí para agregar una imágen de tu oferta</label>
                   <input id="img-oferta" type="file" name="img-oferta"/>
                  
               </div>
               <div class="part-izq">
                    <div class="item-input first-input input-editar">
                         <div class="titulo-input">Título principal</div>
                         <input value="<?= $oferta['nombre']?>" name="nom-oferta1" type="text" 
                                placeholder="EJEMPLO: ¡VODKA + BEBIDA + HIELO! ¡La Florida!" 
                                class="editable nom-oferta-editable requerido"
                                />
                         <label class="mensaje-error error-nombre1">* Campo requerido</label>
                    </div> 

                     <div class="item-input">
                         <div class="titulo-input">Título secundario</div>
                         <input value="<?= $oferta['nombre2']?>" name="nom-oferta2" type="text" 
                                class="editable nom-oferta2 requerido" 
                                placeholder="EJEMPLO: No te lo puedes perder ven a Botillería Don Pato, La Florida."
                                >
                         <label class="mensaje-error error-nombre2">* Campo requerido</label>
                     </div>

     <!--               <div class="item-input">
                          <div class="titulo-input">Título opcional</div>
                         <input value="" name="texto-oferta" type="text" placeholder="EJEMPLO: ¡QUÉ ESPERAS! Disfruta esta rica promoción AHORA MISMO" class="desc-oferta editable">
                    </div>-->

                   <div class="precio-editable">
                             <div class="precio-oferta-edit item-input">
                                 Precio de oferta: $ 
                                         <input name="precio-oferta"  
                                                value="<?= $oferta['precio_oferta']?>" type="text" 
                                                placeholder="3.900" class="precio-desc2 label-red editable requerido"
                                                >
                                 <label class="mensaje-error error-precio1">* Campo requerido</label>
                             </div> 

                             <div class="precio-real2 precio-real-edit item-input">
                                 Precio real: $ 
                                         <input name="precio-real" value="<?= $oferta['precio_real']?>" 
                                                id="precio-real" type="text" placeholder="5.900" 
                                                class="editable requerido" 
                                                >
                                 <label class="mensaje-error error-precio2">* Campo requerido</label>
                             </div>
                      </div>
              </div>
              <div class="tipo-img tipo-img-ed">
                  <?php if($oferta['precio_oferta'] == 1){?>
                        <div class="option-img">
                             <input checked="checked" type="radio" name="tipo_imagen" value="1"/>
                            <label>Imágen referencial</label>
                        </div>
                       <div class="option-img">
                          <input type="radio" name="tipo_imagen" value="2"/>
                          <label>Imágen 100% real</label>
                        </div>
                  <?php }else{?>
                         <div class="option-img">
                             <input type="radio" name="tipo_imagen" value="1"/>
                            <label>Imágen referencial</label>
                        </div>
                       <div class="option-img">
                          <input checked="checked" type="radio" name="tipo_imagen" value="2"/>
                          <label>Imágen 100% real</label>
                        </div>
                  <?php }?>
               </div>
            </div>
            <div class="col-md-4 info-editar">
                <h2 class="bold h-sinmarg info-cupon">Información del cupón</h2>
                <div class="oferta-generada">
                    <div class="descripcion">
                        <h4>Detalles (Deja claro: Marca del producto, contenido como cc, litros, gr, etc.)</h4>
                        <?php 
                            $detaPartes = explode('<li>', $oferta['detalles']);
                        ?>
                        <ul class="ul-editable">
                            
                             <?php for($i=0; $i<count($detaPartes); $i++){
                                     if($i != 0){
                                            $detalles = str_replace('</li>', '',  $detaPartes[$i]); ?>
                                           <li>
                                               <input value="<?= $detalles ?>" placeholder="EJEMPLO: 1 Ron de Litro" type="text" class="editable item2-info-oferta requerido" required="true">
                                               <?php if($i != 1){?>
                                                    <a class="eliminar-item" href="#">Eliminar</a>
                                               <?php }?>
                                               <label class="mensaje-error error-item2">* Campo requerido</label>
                                           </li>
                            <?php   }
                                
                                  }
                             ?>                            
                        </ul>
                        <a class="agregar-detalle" href="#"><h5>+ Agregar otro detalle</h5></a>
                        <input id="descripcion-oferta" name="descripcion-oferta" type="hidden"/>
                    </div>
                    <div class="condiciones">
                        <h4>Condiciones</h4>
                        <?php 
                            $condiPartes = explode('<li>', $oferta['condiciones']);
                        ?>
                        <ul class="ul-editable">
                                <li class="default">Descuento válido sólo mencionando el código del cupón.</li>
                                <li class="default">Cupón con vigencia de 12 horas para canjearlo una vez generado.</li>
                                <li class="default">Válido sólo para mayores de 18 años de edad, presentando su carnet 
                                de identidad en el local!</li>
                                <li class="default">Sujeto a stock diario del local.</li>
                                <li class="default">Sin límite de cupones por persona!</li>
                                <?php if($oferta['forma_pago'] == 1){?>
                                    <div class="select"><input class="no" checked="checked" name="forma_pago" value="1" id="check-efectivo" type="radio"/>Pago sólo en efectivo</div>
                                    <div class="select"><input class="no" name="forma_pago" value="2" id="check-todomdp" type="radio"/>Redcompra y efectivo</div>
                                <?php }else{?>
                                    <div class="select"><input class="no" name="forma_pago" value="1" id="check-efectivo" type="radio"/>Pago sólo en efectivo</div>
                                    <div class="select"><input class="no" checked="checked" value="2" name="forma_pago" id="check-todomdp" type="radio"/>Redcompra y efectivo</div>
                                <?php }?>    
                               
                                
                                 <?php if($oferta['despacho'] == 0){ 
                                     $style="display:none"; ?>
                                   <div class="select"><input class="no" name="despacho" id="check-despacho" type="checkbox"/>Despacho a domicilio </div>
                                <?php }else{ 
                                    $style="display:block";?>
                                   <div class="select"><input class="no" checked="checked" name="despacho" id="check-despacho" type="checkbox"/>Despacho a domicilio </div>
                                <?php }?> 
                                
                                
                                <div id="info-despacho" style="<?= $style?>">
                                  
                                    <div>Áreas de despacho: <input class="no form-control" name="areas" value="<?= $oferta['areas']?>"  id="areas" type="text" placeholder="Ej:La florida, Macul, etc."/></div>
                                </div>
                            <?php for($i=0; $i<count($condiPartes); $i++){
                                    if($i != 0){
            
                                            $condicion = str_replace('</li>', '',  $condiPartes[$i]); ?>
                                           <li>
                                               <input value="<?= $condicion ?>" placeholder="EJEMPLO: Sujeto a stock diario del local" type="text" class="editable item1-info-oferta requerido" required="true">
                                                <a class="eliminar-item" href="#">Eliminar</a>
                                               <label class="mensaje-error error-item1">* Campo requerido</label>
                                           </li>
                              <?php   }
                                }
                             ?>
                        </ul>
                        <a class="agregar-condicion" href="#"><h5>+ Agregar otra condición</h5></a>
                        <input id="condiciones-oferta" name="condiciones-oferta" type="hidden"/>
                    </div>
                    
                    
                </div>
                 
           </div>
          <div class="col-md-4">
              <div class="container-nuevo">   
                   <input type="submit" value="Guardar Cambios" name="editarOferta" id="guardar-cambios" class="btn btn-success btn-lg" href="#" role="button">
              </div>
              <div class="container-nuevo">
                   <a  id="btn-volver" class=" btn btn-danger btn-lg" href="http://www.faltacopete.cl/home-admin" role="button">Volver</a>
              </div>
          </div>
      
      </div>
      <input type="hidden" name="id" value="<?= $oferta['id']?>">
</div>
</form>