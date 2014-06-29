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
    $idBoti = $_SESSION['id_boti'];
    $botilleriaFound = $botilleria->verPorId($idBoti);
?>
<div <?= $page_class ?>>
    <form id="formulario3" name="formulario3" method="POST" action="http://www.faltacopete.cl/function/upload-oferta.php" enctype="multipart/form-data">   
      <div class="row">
       <div class="col-md-4">
            <h2 class="bienvenido">
                Bienvenido <label><?= $botilleriaFound['nombre']?> :)</label>
            </h2>
            <div class="msj-oferta">
              Crea tu OFERTA EXCLUSIVA! <br> atrae más clientes y haz la diferencia del sector.
            </div>
       </div> 
            <div class="col-md-4 content-input-oferta primera-parte">
                <div class="container">
<!--                    <div class="texto">
                                         En el momento que guardes esta nueva oferta apretando el botón de abajo "Guardar oferta",
                                         los administradores revisarán que su depósito esté efectuado.
                                         En menos de 24 horas los administradores activarán tu oferta.
                                         Recibirás un e-mail con la URL de la oferta para que la puedas visualizar en nuestro sitio web.
                                         <br><br>
                                         Si no haz realizado el depósito, solicita nuestros datos en <a href="http://faltacopete.cl/contacto">http://faltacopete.cl/contacto</a> y
                                         haz todas las consultas que tengas. Cuando deposites, en menos de 24 horas nuestro equipo activará
                                         tu oferta, y no te preocupes, los días de permanencia de la oferta corren a partir del momento que nuestro equipo
                                         la active.

                                         <br><br>
                                         <label class="atte">Atte. El equipo de Faltacopete.cl <br> SUERTE!</label>

                    </div>-->
                </div>
               <h2 class="titulo-editar">Agrega tu nueva oferta:</h2>
               <div style="" id="vistaPrevia" class="nueva-foto2 img-oferta img-thumbnail">
                   <label class="label-img">Haz click aquí para agregar una imágen de tu oferta</label>
                   <input id="img-oferta" type="file" name="img-oferta" class="requerido"/>
                   <label class="mensaje-error error-foto">* Campo requerido</label>
               </div>
               
               <div class="part-izq">
                        <div class="item-input first-input input-editar">
                             <div class="titulo-input">Título principal</div>
                                 <input name="nom-oferta1" type="text" 
                                    placeholder="EJEMPLO: ¡VODKA + BEBIDA + HIELO! ¡La Florida!" 
                                    class="editable nom-oferta-editable requerido"
                                    required="true"/>
                             <label class="mensaje-error error-nombre1">* Campo requerido</label>
                        </div>  
                        <div class="item-input">
                             <div class="titulo-input">Título secundario</div>
                              <input name="nom-oferta2" type="text" 
                                    class="editable nom-oferta2 requerido" 
                                    placeholder="EJEMPLO: No te lo puedes perder ven a Botillería Don Pato, La Florida."
                                    required="true">
                             <label class="mensaje-error error-nombre2">* Campo requerido</label>
                        </div>
         <!--               <div class="item-input">
                             <input name="texto-oferta" type="text" placeholder="EJEMPLO: ¡QUÉ ESPERAS! Disfruta esta rica promoción AHORA MISMO" class="desc-oferta editable">
                        </div>-->
                       <div class="precio-editable">
                                 <div class="precio-oferta-edit item-input">
                                      Precio de oferta: $ 
                                     <input name="precio-oferta" type="text" placeholder="3.900" 
                                            class="precio-desc2 label-red editable requerido"
                                             required="true">
                                     <label class="mensaje-error error-precio1">* Campo requerido</label>
                                 </div> 

                                 <div class="precio-real2 precio-real-edit item-input">
                                     Precio real: $
                                     <input name="precio-real" id="precio-real" type="text" 
                                            placeholder="5.900" class="editable requerido" 
                                             required="true">
                                     <label class="mensaje-error error-precio2">* Campo requerido</label>
                                 </div> 
                       </div>
                </div>
               <div class="tipo-img tipo-img-ed">
                   <div class="option-img">
                      <input checked="checked" type="radio" name="tipo_imagen" value="1"/>
                     <label>Imágen referencial</label>
                     
                   </div>
                   <div class="option-img">
                     <input type="radio" name="tipo_imagen" value="2"/>
                     <label>Imágen 100% real</label>
                   </div>
               </div>
            </div>
            <div class="col-md-4 info-editar">
                <h2 class="bold h-sinmarg info-cupon">Información del cupón</h2>
                <div class="oferta-generada">
                    <div class="descripcion">
                        <h4>Detalles (Deja claro: Marca del producto, contenido como cc, litros, gr, etc.)</h4>
                        <ul class="ul-editable">
                            <li>
                               <input  placeholder="EJEMPLO: Un Ron de Litro" type="text" class="editable item2-info-oferta requerido"  required="true">
                            
                               <label class="mensaje-error error-item2">* Campo requerido</label>
                            </li>
                            
                        </ul>
                        <a class="agregar-detalle" href="#"><h5>+ Agregar otro detalle</h5></a>
                        <input id="descripcion-oferta" name="descripcion-oferta" type="hidden"/>
                    </div>
                    <div class="condiciones">
                        <h4>Condiciones</h4>
                        <ul class="ul-editable">
                            <!--<li class="editable" contenteditable="true">Sujeto a stock diario del local</li>-->
                                <li class="default">Descuento válido sólo mencionando el código del cupón.</li>
                                <li class="default">Cupón con vigencia de 12 horas para canjearlo una vez generado.</li>
                                <li class="default">Válido sólo para mayores de 18 años de edad, presentando su carnet 
                                de identidad en el local!</li>
                                <li class="default">Sujeto a stock diario del local.</li>
                                <li class="default">Sin límite de cupones por persona!</li>
                                <div class="select"><input class="no" value="1" checked="checked" name="forma_pago" id="check-efectivo" type="radio"/>Pago sólo en efectivo</div>
                                <div class="select"><input class="no" value="2" name="forma_pago" id="check-todomdp" type="radio"/>Redcompra y efectivo</div>
                                <div class="select"><input class="no" value="1" name="despacho" id="check-despacho" type="checkbox"/>Despacho a domicilio </div>
                                <div id="info-despacho">
                                   
                                    <div>Áreas de despacho: <input name="areas" id="areas" class="form-control no" type="text" placeholder="Ej:La florida, Macul, etc."/></div>
                                </div>                               
                                <label class="mensaje-error error-item1">* Campo requerido</label>
                            
                        </ul>
                        <a class="agregar-condicion" href="#"><h5>+ Agregar otra condición</h5></a>
                        <input id="condiciones-oferta" name="condiciones-oferta" type="hidden"/>
                    </div>
                    
                    
                </div>
                 
           </div>
          <div class="col-md-4">
              <div class="container-nuevo">
                   
                   <input name="guardaroferta" type="submit" id="guardar-oferta" class="btn btn-success btn-lg" href="#" role="button" value="Guardar Oferta">
              </div>
          </div>
       
      </div>
     <input type="hidden" value="<?= $_SESSION['id_boti']?>" name="id_boti"/>
 </form>
</div>