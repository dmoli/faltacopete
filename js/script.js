$(document).ready(function(){
    path = '/';
  /* COVERALL   ***************************************************** */
	mouseOverAll = false; 	
	$('body').delegate('#caloader','mouseenter', function(){
	    mouseOverAll = true; 
	}).delegate('#caloader','mouseleave', function(){
	    mouseOverAll = false; 
	});
        $('body').delegate('.cerrar-cf','mouseenter', function(){
	    mouseOverAll = true; 
	}).delegate('.cerrar-cf','mouseleave', function(){
	    mouseOverAll = false; 
	});
        function popup(data){
          coverallclose();
          $("html").css("overflow","hidden");
          $("#top").css("right","8px");
          $('#coverall').show();
          $("#coverall > .innercal").fadeIn(0);
          $('#caloader').html(data);
          
      }
	function coverallclose(){	
		$("#coverall").fadeOut(0, 
			function(){
				$("#coverall > .innercal").css("display", "none");
				$("html").css("overflow-y", "scroll");
				$("#caloader").html("");
			}
		);
	}
        function coverallclose3(){
		$("#coverall3").fadeOut(0, 
			function(){
				$("#coverall3").css("display", "none");
				$("html").css("overflow-y", "scroll");
			}
		);
	}
	$("#coverall").click(
		function(){
			if (!mouseOverAll){
				coverallclose();
                                
			}			
        });
        $("#coverall3").click(               
		function(){
			if (!mouseOverAll){
				coverallclose2();
                                
			}			
        });
        $('.aceptar').click(
		function(){
			if (!mouseOverAll){
				coverallclose();
                                
			}
        });
       /*FIN COVERALL*/
       /* INICIO */
        $('#no-mayor').click(function(){
            $('.msj-edad').show();
        })
        $('#si-mayor').click(function(){
            $('.msj-edad').hide();
            recordar = 0;
            if($('#recordar-edad').is(':checked')){
                recordar = 1;
            }
             $.post(path+'function/cupon-response.php', {'si-mayor':1, 'recordar':recordar},
                    function(data){
                        window.location.href = "http://www.faltacopete.cl";
                    }, "JSON");
        })
        $('body').delegate('#btn-cerrar-cf','click',function(){
            coverallclose3();
        })
        $('#como-funciona').click(function(){
            $.post(path+'json/zoom.php', {'como-funciona':1},
                    function(data){
                        $("html").css("overflow","hidden");
                        $('#coverall3').show()
                    }, "html");
          return false;
        })
       //FIN INICIO 
       //NAVEGACION
        $('#cupones-recientes').click(function(){
            $('.cupones-session').toggle();
        })
        $('#ver-noti').click(function(){
            $('.cupones-session').toggle();
        })
        $('#btn-search').click(function(){
            q = $('#search').val();
            qfinal = q.replace(/ /g,'-');
            window.location.href = "http://www.faltacopete.cl/home/"+qfinal;
        })
        $('#search').keyup(function(k){
            if(k.keyCode == 13){
                 q = $('#search').val();
                qfinal = q.replace(/ /g,'-');
                window.location.href = "http://www.faltacopete.cl/home/"+qfinal;
            }
        })
        $('#sector-actual').click(function(){
            if(!$('#lista-sector').is(':visible')){//si lo muestro tiro la pag para arriba
                $(document).scrollTop(0);
            }
           $('#lista-sector').toggle(); 
           return false;
        });
        $('#sector-actual .arrow').click(function(){
            if(!$('#lista-sector').is(':visible')){//si lo muestro tiro la pag para arriba
                $(document).scrollTop(0);
            }
           $('#lista-sector').toggle(); 
            return false;
        });
       //FIN NAVEGACION
       //CONTACTO
       $('#enviar-contacto').click(function(){
           if(comprobarCampos4()){
              return false;
           }
            popup('<label class="msj-popup">Enviando Mensaje...</label>');
            nombre = $('#nombre-contacto').val();
            email = $('#email-contacto').val();
            fono = $('#celu-contacto').val();
            msj = $('#mensaje-contacto').val();
            $.post(path+'function/send.php', {'contacto':1, 'nombre':nombre, 'email':email,'fono':fono,'msj':msj},
                    function(data){
                                if(data.re == 1){
                                    popup(data.html);
                                }else{
                                    popup(data.html);
                                }                                
                    }, "JSON");
       })
       //FIN CONTACTO
       /*PERFIL CUPON*/
       
       $('body').delegate('#ver-terminos','click',function(){
           $('.terminos').fadeIn();
           return false;
       })
       $('body').delegate('#cerrar-terminos','click',function(){
           $('.terminos').fadeOut();
           return false;
       })
       $('#ver-comentarios').click(function(){
           popup(':)');
           return false;
       })
       $('#generar-cupon').click(function(){
           popup('<label class="msj-popup">Generando Cupón...</label>');
           $.post(path+'json/zoom.php', {'generar-cupon1':1},
                    function(data){
                                popup(data);
                                if($('#fb-logged').val() == 1){
                                    $('#nombre-usuario').val($('#nombrefb').val());
                                    $('#email-usuario').val($('#emailfb').val());
                                    $('#foto-facebook').attr('src',$('#fotofb').val());
                                    $('#check-face').fadeIn();
                                }
                    }, "html");
           return false;
       })
        $('body').delegate('.login-fb','click',function(){
            login();
        })
        // Funcion para logarse con Facebook.
        function login() {
          fb.login(function(){ 
            if (fb.logged) {
              // Cambiamos el link de identificarse por el nombre y la foto del usuario.
              $('#nombre-usuario').val(fb.user.name);
              $('#email-usuario').val(fb.user.email);
              $('#foto-facebook').attr('src',fb.user.picture)
              //html de la pág
              $('#fb-logged').val('1');
              $('#nombrefb').val(fb.user.name);
              $('#emailfb').val(fb.user.email);
              $('#fotofb').val(fb.user.picture);
              $('#check-face').show();           
            } else {
              alert("No se pudo identificar al usuario");
            }
          })
        };
       /*FIN PERFIL CUPÓN*/
       /*AGREGAR OFERTA*/
       function comprobarCampos(){  
            error = false;
            $('.requerido').each(function(){
                input = $(this);
                if(trim(input.val()) == ''){
                    error = true;
                    input.parent().find('.mensaje-error').show(200);
                    input.css('border','2px solid #f00');
                }else{
                     input.parent().find('.mensaje-error').hide(200)
                    input.css('border','1px dashed rgba(85, 85, 85, 0.72)');
                }
            });
            return error;
        }
        function comprobarCampos3(){  
            error = false;
            $('.content-popup .requerido').each(function(){
                input = $(this);
                if(trim(input.val()) == ''){
                    error = true;
                    input.parent().find('.mensaje-error').show(200);
                    input.css('border','2px solid #f00');
                }else{
                     input.parent().find('.mensaje-error').hide(200)
                    input.css('border','1px solid #cccccc');
                }
            });
            return error;
        }
        function comprobarCampos4(){  
            error = false;
            $('.requerido').each(function(){
                input = $(this);
                if(trim(input.val()) == ''){
                    error = true;
                    input.parent().find('.mensaje-error').show(200);
                    input.css('border','2px solid #f00');
                }else{
                     input.parent().find('.mensaje-error').hide(200)
                    input.css('border','1px solid #cccccc');
                }
            });
            return error;
        }
        function comprobarCampos2(){
            
            error = false;
            error2 = false;
            cant = 0;
            $('.item1-info-oferta').each(function(){
                input = $(this);
                cant = 1;
                if(trim(input.val()) == ''){
                    error = true;
                    input.parent().find('.mensaje-error').show(200);
                    input.css('border','2px solid #f00');
                    input.focus();
                }else{
                    input.parent().find('.mensaje-error').hide(200)
                    input.css('border','1px dashed rgba(85, 85, 85, 0.72)');
                }
            });

            if(!error)
                    if(cant == 0 ){
                            error = true;
                            $('.condiciones .ul-editable').html('<li><input placeholder="EJEMPLO: Sujeto a stock diario del local" \n\
                                                                    type="text" class="editable item1-info-oferta">\n\
                                                                    <a class="eliminar-item" href="#">Eliminar</a>\n\
                                                                    <label class="mensaje-error error-item1">* Campo requerido</label>\n\
                                                                </li>');
                            $('.condiciones .ul-editable').find('.mensaje-error').show(200);
                            $('.condiciones .ul-editable .item1-info-oferta').css('border','2px solid #f00');
                            $('.condiciones .ul-editable .item1-info-oferta').focus();
                    }else{
                            $('.condiciones .ul-editable').find('.mensaje-error').hide(200);
                            $('.condiciones .ul-editable .item1-info-oferta').css('1px dashed rgba(85, 85, 85, 0.72)');
                    }
                        
            //////////
            cant2 = 0;
            $('.item2-info-oferta').each(function(){
                input = $(this);
                cant2 = 1;
                if(trim(input.val()) == ''){
                    error2 = true;
                    input.parent().find('.mensaje-error').show(200);
                    input.css('border','2px solid #f00');
                    input.focus();
                }else{
                    input.parent().find('.mensaje-error').hide(200)
                    input.css('border','1px dashed rgba(85, 85, 85, 0.72)');
                }
            });
             if(!error2)
                    if(cant2 == 0 ){
                            error2 = true;
                            $('.descripcion .ul-editable').html('<li><input placeholder="EJEMPLO: 1 BEBIDA DE LITRO" \n\
                                                                    type="text" class="editable item2-info-oferta">\n\
                                                                    <a class="eliminar-item" href="#">Eliminar</a>\n\
                                                                    <label class="mensaje-error error-item2">* Campo requerido</label>\n\
                                                                </li>');
                            $('.descripcion .ul-editable').find('.mensaje-error').show(200);
                            $('.descripcion .ul-editable .item2-info-oferta').css('border','2px solid #f00');
                            $('.descripcion .ul-editable .item2-info-oferta').focus();
                    }else{
                            $('.descripcion .ul-editable').find('.mensaje-error').hide(200);
                            $('.descripcion .ul-editable .item2-info-oferta').css('1px dashed rgba(85, 85, 85, 0.72)');
                    }
//            alert(cant2);alert(error2)
            if(error || error2){//si uno de los dos tiene error
                return true;
            }else{
                return false;
            }
        }
        
       $('#formulario2').submit(function(){//editar oferta
           
           descripcion = '';
           enviar = true;
           $('.descripcion .ul-editable input').each(function(){
               descripcion+= '<li>'+$(this).val()+'</li>';
           })
           $('#descripcion-oferta').val(descripcion);
           
           condiciones = '';
           $('.condiciones .ul-editable input').each(function(){
               if(!$(this).hasClass('no')){
                condiciones+= '<li>'+$(this).val()+'</li>';
               }
           })
           $('#condiciones-oferta').val(condiciones);
           if(comprobarCampos()){//hay campos vacios
                enviar = false;
           }
           return enviar;
       })
            $('#check-despacho').change(function(){
               if($('#info-despacho').is(':visible')){
                   $('#info-despacho').hide();
               }else{
                   $('#info-despacho').show();
               }
           });
        $('#formulario3').submit(function(){//guardar oferta
          
           descripcion = '';
           enviar = true;
           $('.descripcion .ul-editable input').each(function(){
               if(trim($(this).val()) != '' ){
                    descripcion+= '<li>'+$(this).val()+'</li>';
               }
           })
           $('#descripcion-oferta').val(descripcion);
           
           condiciones = '';
           $('.condiciones .ul-editable input').each(function(){
               if(trim($(this).val()) != '' ){
                    if(!$(this).hasClass('no')){
                         condiciones+= '<li>'+$(this).val()+'</li>';
                    }
               }
           })
           $('#condiciones-oferta').val(condiciones);
            if(comprobarCampos()){//hay campos vacios
                enviar = false;
           }
           return enviar;
       })
        $('body').delegate('.eliminar-item','click',function(){
            $(this).parent().remove();
            return false;
        })
        $('.agregar-condicion').click(function(){
            content = '<li>\n\
                                <input placeholder="EJEMPLO: Sólo con efectivo" type="text" class="editable item1-info-oferta">\n\
                                <a class="eliminar-item" href="#">Eliminar</a>\n\
                               <label class="mensaje-error error-item1">* Campo requerido</label>\n\
                      </li>';
            $(this).parent().find('ul').append(content);
            return false;
        })
       $('.agregar-detalle').click(function(){
           content = '<li>\n\
                                <input placeholder="EJEMPLO: 1 RON MARCA X de 1.5 lt" type="text" class="editable item2-info-oferta requerido" required="true">\n\
                                <a class="eliminar-item" href="#">Eliminar</a>\n\
                                <label class="mensaje-error error-item2">* Campo requerido</label>\n\
                        </li>';
            $(this).parent().find('ul').append(content);
            return false;
        })
        
       $('body').on('change', '#img-oferta', function(e) {
            window.mostrarVistaPrevia();
        });
        window.mostrarVistaPrevia = function mostrarVistaPrevia() {
            var Archivos, Lector;
            //Para navegadores antiguos
            if (typeof FileReader !== "function") {
                jQuery('#infoNombre').text('[Vista previa no disponible]');
                jQuery('#infoTamaño').text('(su navegador no soporta vista previa!)');
                return;
            }

            Archivos = jQuery('#img-oferta')[0].files;
            if (Archivos.length > 0) {

                Lector = new FileReader();
                Lector.onloadend = function(e) {
                    var origen, tipo;

                    //Envia la imagen a la pantalla
                    origen = e.target; //objeto FileReader
                    //Prepara la información sobre la imagen
                    tipo = window.obtenerTipoMIME(origen.result.substring(0, 30));

                    jQuery('#infoNombre').text(Archivos[0].name + ' (Tipo: ' + tipo + ')');
                    jQuery('#infoTamaño').text('Tamaño: ' + e.total + ' bytes');
                    //Si el tipo de archivo es válido lo muestra, 
                    //sino muestra un mensaje 
                    if (tipo !== 'image/jpeg' && tipo !== 'image/png' && tipo !== 'image/gif') {
                        alert('El formato de imagen no es válido: debe seleccionar una imagen JPG, PNG o GIF.');
                    } else {

                        $('#vistaPrevia').attr('style', "background-image:url("+origen.result+")");
                    }

                };
                Lector.onerror = function(e) {
                    console.log(e)
                }
                Lector.readAsDataURL(Archivos[0]);

            } else {
                var objeto = jQuery('#archivo');
                objeto.replaceWith(objeto.val('').clone());
                jQuery('#vistaPrevia').attr('style="background-image"', window.imagenVacia);
                jQuery('#infoNombre').text('[Seleccione una imagen]');
                jQuery('#infoTamaño').text('');
            };


        };

        //Lee el tipo MIME de la cabecera de la imagen
        window.obtenerTipoMIME = function obtenerTipoMIME(cabecera) {
            return cabecera.replace(/data:([^;]+).*/, '\$1');
        }   
       /*FIN AGREGAR OFERTA*/
       //HOME ADMIN
       
       $('#olvide-clave').click(function(){//popup 
           popup('<label class="msj-popup">Cargando...</label>');
           $.post(path+'json/zoom.php', {'olvide-clave1':1},
                    function(data){
                                popup(data)
                    }, "html");
           return false;
        })
        $('body').delegate('#recuperar-clave','click', function(){ 
           if(comprobarCampos()){
               return false;
           }
           $('#load').fadeIn();
           usuario = $('#usuario2').val();
           $.post(path+'function/send.php', {'recuperar-clave':1, 'usuario':usuario},
                    function(data){
                                $('#load').fadeOut();
                                if(data.re == -1){
                                    $('.error-clave-ac').html('Usuario no encontrado');
                                    $('.error-clave-ac').show();
                                }else{
                                  if(data.re == -2){
                                    $('.error-clave-ac').html('Error 566');
                                    $('.error-clave-ac').show();
                                  }else{
                                    $('.error-clave-ac').hide();
                                    $('.error-clave-ac').html('* Campo requerido');
                                    popup('<label class="msj-popup">Se ha enviado un correo electrónico a '+data.email+'</label>'); 
                                }
                            }
                                
                    }, "JSON");
           return false;
        })
        
        $('#activar-cupon').click(function(){//popup
           popup('<label class="msj-popup">Cargando...</label>');
           idOferta = $(this).attr('data-id');
           $.post(path+'json/zoom.php', {'activar-cupon':1, idOferta: idOferta},
                    function(data){
                                popup(data)
                    }, "html");
           return false;
        })
         $('body').delegate('#activar-cupon2','click',function(){
           popup('<label class="msj-popup">Cargando...</label>');
           idOferta = $(this).attr('data-id');
           id_boti = $('#id_boti').val();
           $.post(path+'function/cupon-response.php', {'activar-cupon2':1, idOferta: idOferta, 'id_boti':id_boti},
                    function(data){
                               window.location.reload();
                    }, "html");
           return false;
        })
        $('body').delegate('#cambiarClave','click',function(){
            popup('<label class="msj-popup">Cargando...</label>');
            $.post(path+'json/zoom.php', {'cambiar-clave':1},
                      function(data){
                                  popup(data)
                      }, "html");
             return false;
        })
         $('body').delegate('#cambiar-clave2','click',function(){
           if(comprobarCampos3())
               return false;
           claveActual = $('#clave-actual').val();
           nuevaClave1 = $('#nueva-clave1').val();
           nuevaClave2 = $('#nueva-clave2').val();
           if(trim(nuevaClave1) != trim(nuevaClave2)){
               $('.error-clave1').html('Las claves no coinciden');
               $('.error-clave1').show();
               return false;
           }else{
               $('.error-clave1').hide();
               $('.error-clave1').html('* Campo requerido');
           }
           id_boti = $('#id_boti').val();
           $.post(path+'function/cupon-response.php', {'comprobar-clave':1, 'claveActual': claveActual, 'id_boti':id_boti},
                    function(data){
                               if(data == 1){
                                   $('.error-clave-ac').hide();
                                   $('.error-clave-ac').html('* Campo requerido');
                                   $.post(path+'function/cupon-response.php', {'modificar-clave':1, 'clave': nuevaClave1, 'id_boti':id_boti},
                                            function(data2){
                                                       if(data2 == 1){
                                                           popup('<label class="msj-popup">Cambiando clave...</label>');
                                                           window.location.reload();
                                                       }else{
                                                           $('.error-clave-ac').html('Ocurrió un error: 335, vuelva a intentarlo');
                                                           $('.error-clave-ac').show();
                                                       }
                                            }, "html");
                               }else{
                                   $('.error-clave-ac').html('La clave es incorrecta');
                                   $('.error-clave-ac').show();
                               }
                    }, "html");
           return false;
        })
       //FIN HOME ADMIN
       /*CUPÓN*/
       $('body').delegate('#generar-cupon2','click',function(){
            if($('#fb-logged').val() == 0){//NO logeado con face
               
                generarCupon();
                
            }else{//si logeado con Face
               if($('#publicar-muro').is(':checked')){//No publicar en el muro
                  
                  generarCupon(); 
               }else{//publicar en el face
                 
                 fotoface = $('#foto-face').val();
                 linkface = $('#link-face').val();
                 tituloface = $('#titulo-face').val();
//                 alert(fotoface);alert(linkface);alert(tituloface)
                 fb.publish({
                        message : "Acaba de Generar Gratis un cupón de descuento en Faltacopete.cl !!",
                        picture : fotoface,
                        link : linkface,
                        name : tituloface,
                        description : "Entra a http://www.faltacopete.cl y aprovecha todos los descuentos para que el carrete sea más barato!"
                      },function(published){ 
//                            alert(published)
                            generarCupon();
                      }); 
                }
            }
       })
       function generarCupon(){
                       if(comprobarCampos3()){
                            return false;
                        }
                        if(!$('#condiciones').is(':checked')){
                            $('#error-terminos').show();
                            return false;
                        }else{
                             $('#error-terminos').hide();
                        }           
                        idOferta = $('#generar-cupon').attr('data-idOferta');
                        nombre = $('#nombre-usuario').val();
                        email = $('#email-usuario').val();
                        comuna = $('#comuna').val();
                        popup('<label class="msj-popup">Generando Cupón...</label>');
                        $.ajax({
                                  type:"POST",
                                  dataType:"json",
                                  url:path+"function/cupon-response.php",
                                  data:"generar-cupon2=1&idOferta="+idOferta+"&nombre="+nombre+"&email="+email+"&comuna="+comuna,
                                  success:function(data)
                                  {
                                      if(data.re == 1){
                                          $.ajax({//mail
                                                      type:"POST",
                                                      dataType:"json",
                                                      url:path+"function/send.php",
                                                      data:"mailCupon=1&nombre="+nombre+"&codigo="+data.codigo+"&idCupon="+idOferta+"&para="+email,
                                                      success:function(data)
                                                      {
                                                      }
                                            });
                                           window.location.href = "http://www.faltacopete.cl/generar-cupon/"+data.id;
                                      }
                                  }
                        });
       }

       /*FIN CUPÓN*/
      function trim(cadena){
        // USO: Devuelve un string como el parámetro cadena pero quitando los espacios en blanco de los bordes.
        var retorno=cadena.replace(/^\s+/g,'');
        retorno=retorno.replace(/\s+$/g,'');
        return retorno;
        }
      function ucFirst(string){
        return string.substr(0,1).toUpperCase()+string.substr(1,string.length).toLowerCase();
     }
});
