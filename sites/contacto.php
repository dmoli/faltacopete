<div <?= $page_class ?>>
     
      <div class="row">
        <h2 class="titulo-pagina">Contáctate con nosotros:</h2>
        <div class="col-md-4">
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
     
     
</div>