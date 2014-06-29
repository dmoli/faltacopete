<?php
    if(!isset($_SESSION["id_boti"])){
        header('location:http://www.faltacopete.cl/login');
    }else{
     //   calcular el tiempo transcurrido
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
    $ofertaVigente = $botilleria->verOfertaVigente($idBoti);
    if($ofertaVigente == null){
         header("location:http://faltacopete.cl/nueva-oferta");
    }
    $botilleriaFound = $botilleria->verPorId($idBoti);
?>
<div <?= $page_class ?>>
    <form name="formulario1" method="POST" action="http://www.faltacopete.cl/function/upload-oferta.php" enctype="multipart/form-data">   
      <div class="row">
       <div class="col-md-4">
            <h2 class="bienvenido">
                Bienvenido <label><?= $botilleriaFound['nombre'] ?> :)</label>
                <?php //var_dump($_SESSION);?>
            </h2>
            <div class="msj-oferta">
              Crea tu OFERTA EXCLUSIVA! <br> atrae más clientes y haz la diferencia del sector.
            </div>
        </div>   
        <?php if($ofertaVigente != null){

                $diasRestantesNum = $botilleria->dateDiff($botilleria->hoy(), $ofertaVigente['fecha_caducidad']);
                $diasRestantes = $botilleria->verCaducacion($botilleria->hoy(), $ofertaVigente['fecha_caducidad'], 1);
                //dias de prueba, despues borrar
                     $vigenciaGratis = $botilleria->verVigenciaGratis($idBoti);
                     $dr = $botilleria->dateDiff($botilleria->hoy(), $vigenciaGratis['fecha_termino']);//dias restantes
                //fin borrar
                
                //diasrestantes2, ponerlo cuando hayan pagos
                $diasRestantes2 = $botilleria->verCaducacion($botilleria->hoy(), $ofertaVigente['fecha_caducidad'], 2);
            ?>  
            <?= $diasRestantes?>
            <div class="col-md-4 primera-parte">
                
                <a href="http://www.faltacopete.cl/editar-oferta/<?= $ofertaVigente['id']?>">
                    <div style="background: url(http://www.faltacopete.cl/images/ofertas/<?= $ofertaVigente['foto']?>);
                                background-size: cover; background-repeat: no-repeat" 
                           id="vistaPrevia" class="nueva-foto2 img-oferta img-thumbnail border">
                    </div> 
                </a>
                <div class="part-izq">
                    <h2 class="nom-oferta2">

                          <label> <?= $ofertaVigente['nombre']?></label>
                           <?= $ofertaVigente['nombre2']?>

                    </h2>
                    <p class="desc-oferta"> <?= $ofertaVigente['texto']?></p>
                    <div class="precio-oferta2">
                              <div class="precio-desc2 label-red">$<?= $ofertaVigente['precio_oferta']?></div>
                              <div class="precio-real2">Precio real: <label>$<?= $ofertaVigente['precio_real']?></label></div> 
                    </div>
                    <?php 
                     if($ofertaVigente['estado'] == 0 || $ofertaVigente['estado'] == 2){//si agregada ó aceptada por el administrador
                              if($diasRestantesNum < 0){?>
                                   <a data-id="<?= $ofertaVigente['id'] ?>" href="#" id="activar-cupon" class="btn btn-danger btn-lg" >ACTIVAR esta oferta</a>
                                   <label class="o">O</label>
                                   <a data-id="<?= $ofertaVigente['id'] ?>" href="http://www.faltacopete.cl/nueva-oferta" id="nuevo-cupon" class="btn btn-danger btn-lg" >Crear una nueva oferta</a>
                         <?php }else{?>
                                   <a href="http://www.faltacopete.cl/editar-oferta/<?= $ofertaVigente['id']?>" id="editar-oferta" class="btn btn-success btn-lg" >Editar oferta</a>
                         <?php }
                     }else{?>
                                  <a id="pendiente" href="#" title="Su oferta será aceptada por los administradores" class="btn btn-primary btn-lg">Pendiente...</a>
                                  <label class="msj-pendiente">¿Qué significa pendiente? <br>Tu oferta está siendo revisada por los administradores, apenas se active te enviaremos un correo electrónico, gracias.</label>
                     <?php }?>            
                    <div class="info-oferta2">
                        <div class="generado-por2">Generado por: <label><?= $ofertaVigente['cant_generado']?> personas</label></div>

                        <div class="expira-en2"><?= 'Tus ofertas expiran en: <label><b>'.$dr.' días</b></label>'?></div>

                    </div>
                     <div class="face-cupon2">
                            <div class="fb-like" 
                                 data-href="http://www.faltacopete.cl/cupon/<?= $ofertaVigente['id']?>" 
                                 data-width="300px" 
                                 data-layout="button_count" 
                                 data-action="like" 
                                 data-show-faces="true" 
                                 data-share="false"></div>
                     </div>                          
               </div>
            </div>
        <?php }
    
            ?>
            
      </div>
 </form>
</div>