<?php 
    $stylePopup = 'display:block';
    if(isset($_COOKIE['edad']) == "si"){
           $stylePopup = 'display:none';   
     }elseif(isset($_COOKIE['edad-temporal']) == "si"){
           $stylePopup = 'display:none';
     }
?>
<div id="coverall2" style="<?= $stylePopup?>">
            <div class="innercal city">
                <div id="caloader2">
                    <div class="content-popup">
                         <a class="navbar-brand enlace-logo" href="http://www.faltacopete.cl/home">
                            <img title="Faltacopete.cl" class="logo-small" src="http://www.faltacopete.cl/images/logo.png"/>
                        </a>
                        <h1 class="special-font" id="bienvenido">¡Bienvenido!</h1>
                        <div class="msj-popup2">
                            Somos el único sitio web que te permite obtener Cupones de Descuento
                            en bebidas alcoholicas totalmente GRATIS! en locales asociados.
                        </div>
                        <div class="comofunciona">
                            <div class="tiulo-comofunciona">¿CÓMO FUNCIONA?</div>
                            <div class="paso1 paso">
                                <label>1</label>
                                <div class="texto">Entra a la página y encuentra la oferta cercana que más te convenga.</div>
                            </div>
                            <div class="paso2 paso">
                                <label>2</label>
                                <div class="texto">Pulsa Generar Cupón.</div>
                            </div>
                            <div class="paso3 paso">
                                <label>3</label>
                                <div class="texto">Ingresa tus datos.</div>
                            </div>
                            <div class="paso4 paso">
                                <label>4</label>
                                <div class="texto">Anda al local, menciona el código de descuento de nuestra página web. 
                                Disfruta! :)</div>
                            </div>
                        </div>
                        <div id="edad">
                            <div class="msj-edad">*No tienes edad suficiente para ingresar al sitio.</div>
                            <h2 class="soymayor">¿ERES MAYOR DE EDAD?</h2>
                            <div class="content-respuestas">
                                <div class="respuesta" href="#" id="si-mayor">SI</div>
                                <div class="respuesta" href="#" id="no-mayor">NO</div>
                                <div class="content-recordar">
                                    <input type="checkbox" checked="checked" id="recordar-edad"> Recordar
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
</div>
<div id="coverall3">
            <div class="innercal city">
                <div id="caloader3">
                    <div class="content-popup">
                         <a class="navbar-brand enlace-logo" href="http://www.faltacopete.cl/home">
                            <img title="Faltacopete.cl" class="logo-small" src="http://www.faltacopete.cl/images/logo.png"/>
                        </a>
                        <h1 class="special-font" id="bienvenido">¡Bienvenido!</h1>
                        <div class="msj-popup2">
                            Somos el único sitio web que te permite obtener Cupones de Descuento
                            en bebidas alcoholicas totalmente GRATIS! en locales asociados.
                        </div>
                        <div class="comofunciona">
                            <div class="tiulo-comofunciona">¿CÓMO FUNCIONA?</div>
                            <div class="paso1 paso">
                                <label>1</label>
                                <div class="texto">Entra a la página y encuentra la oferta cercana que más te convenga.</div>
                            </div>
                            <div class="paso2 paso">
                                <label>2</label>
                                <div class="texto">Pulsa Generar Cupón.</div>
                            </div>
                            <div class="paso3 paso">
                                <label>3</label>
                                <div class="texto">Ingresa tus datos.</div>
                            </div>
                            <div class="paso4 paso">
                                <label>4</label>
                                <div class="texto">Anda al local, menciona el código de descuento de nuestra página web. 
                                Disfruta! :)</div>
                            </div>
                        </div>
                        <div id="bottom-cf"><a id="btn-cerrar-cf" class="btn btn-success btn-lg" href="#">Cerrar</a></div>
                    </div>
                </div>
            </div>
    
</div>