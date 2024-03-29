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
    $comunas = $botilleria->verComunas(13);
    $id = $_SESSION['id_boti'];
    $botiEncontrada = $botilleria->verPorId($id);
?>
<div <?= $page_class ?>>
     <form name="formulario1" method="POST" action="http://www.faltacopete.cl/function/upload-oferta.php" enctype="multipart/form-data">   
      <div class="row">
            <div class="col-md-4">
               <h2>Edita la información de tu local:</h2>
               <div style="background-image: url(/images/botillerias/<?= $botiEncontrada['foto']?>)" id="vistaPrevia" class="nueva-foto img-oferta img-thumbnail">
                   <label class="label-img-boti">Haz click aquí para cambiar la foto de tu local</label>
                   <input  id="img-oferta" class="img-botilleria-ed" type="file" name="img-botilleria"/>
                   
               </div>
               <div class="form-group item-input2 first-input">
                    <label for="nombre">Nombre de tu local *</label>
                     <input value="<?= $botiEncontrada['nombre'] ?>" name="nombre-botilleria" type="text" 
                            class=" form-control requerido" id="nombre-botilleria"
                            placeholder="Introduce el nombre aquí" required="true">
                      <label class="mensaje-error error-nombre2">* Campo requerido</label>
                </div>
                <div class="form-group item-input2">
                    <label for="comuna">Comuna *</label>
                    <select name="comuna" class="form-control">
                      <?php foreach ($comunas as $item){
                            if($botiEncontrada['id_comuna'] == $item['codigoInterno']){ ?>
                                <option selected="selected" value="<?= $item['codigoInterno']?>"><?= $item['nombre']?></option>
                      <?php  }else{
                          ?>
                               <option  value="<?= $item['codigoInterno']?>"><?= $item['nombre']?></option>  
                      <?php }}?>
                    </select>
                </div>
                <div class="form-group item-input2">
                    <label for="email">Dirección del local *</label>
                    <input value="<?= $botiEncontrada['direccion'] ?>" name="direccion-botilleria" type="text" 
                           class=" form-control requerido" id="direccion-botilleria"
                           placeholder="Introduce la dirección aquí" required="true">
                     <label class="mensaje-error error-nombre2">* Campo requerido</label>
                </div>
               
                <div class="form-group">
                    <input id="btn-comprobar" type="button" class="btn btn-success" value="Comprobar en el mapa"/>  
                </div>
               <div class="container-map">
                        <div id='map_canvas' style='width: 100%;
                                        height: 100%;
                                        overflow: hidden;
                                        position: relative;
                                        background-color: rgb(229, 227, 223);
                                        -webkit-transform: translateZ(0);'></div>                
               </div>
               <div class="container-right">
                    <div class="form-group item-input2">
                         <label for="Telefono1">Teléfono 1</label>
                         <input value="<?= $botiEncontrada['telefono1'] ?>" name="telefono1-botilleria" type="text" 
                                class=" form-control" id="telefono1-botilleria"
                                placeholder="Introduce un número aquí">
                     </div>
                    <div class="form-group">
                         <label for="Telefono2">Teléfono 2</label>
                         <input value="<?= $botiEncontrada['telefono2'] ?>" name="telefono2-botilleria"type="text" class=" form-control" id="telefono2-botilleria"
                                placeholder="Introduce otro número aquí">

                     </div>
               </div>
               <div class="form-group item-input2">
                        <label for="Telefono2">Horario del local *</label>
                        <textarea  name="horario-botilleria" id="horario-botilleria" class="form-control requerido" 
                                   required="true" rows="5"><?= $botiEncontrada['horario'] ?></textarea> 
                         <label class="mensaje-error error-nombre2">* Campo requerido</label>
               </div>  
            </div>
            
          <div class="col-md-4">
              <div class="container">          
                   <input type="submit" value="Guardar cambios" name="editarBoti" id="guardar-cambios" class="btn btn-success btn-lg" role="button">
              </div>
              <div class="container">
                   <a  id="btn-volver" class=" btn btn-danger btn-lg" href="http://www.faltacopete.cl/home-admin" role="button">Volver</a>
              </div>
          </div>
          <input type="hidden" value="<?= $botiEncontrada['lat']?>" id="lat" name="lat"/>
          <input type="hidden" value="<?= $botiEncontrada['lng']?>" id="lng" name="lng"/>
          <input type="hidden" value="<?= $botiEncontrada['id']?>" name="id"/>
      </div>
     </form>
</div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="/js/maps.js"></script>