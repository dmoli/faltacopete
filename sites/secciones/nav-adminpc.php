<?php if(isset($_SESSION['id_boti'])){
                    $boti = new botilleria();
                    $boti = $boti->verPorId($_SESSION['id_boti']);
                    ?>
                    <!-- admin -->
                    <ul class="nav navbar-nav nav-admin menu-pc">
                         <li><img class="img-abatar"src="http://www.faltacopete.cl/images/botillerias/<?= $boti['foto']?>"/></li>
                         <li><a href="http://www.faltacopete.cl/home-admin" ><span class="nom-abatar">¡Hola! <?= $boti['nombre']?></span></a></li>
                          <li class="option-admin dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Opciones<b class="caret"></b></a>
                              <ul class="dropdown-menu">
                                  <li><a href="http://www.faltacopete.cl/home-admin">Editar promoción</a></li>
                                  <li><a href="http://www.faltacopete.cl/editar-informacion">Editar información del local</a></li>
                                  <li id="cambiarClave"><a href="#">Cambiar Contraseña</a></li>
                                  <li class="divider"></li>
                                  <!--<li class="dropdown-header">Nav header</li>-->
                                   <li><a href="http://www.faltacopete.cl/function/logout.php" id="salir"  >Salir</a></li>
                              </ul>
                        </li>
                    </ul> 
                    <!-- fin admin -->
              <?php }elseif(isset($_SESSION['id_admin'])){//sumer admin
                     $boti = new botilleria();
                     $admin = $boti->verAdminPorId($_SESSION['id_admin']);
                     ?>
                    <ul class="nav navbar-nav nav-admin menu-pc">
                         <li><img class="img-abatar"src="http://www.faltacopete.cl/images/botillerias/<?= $admin['foto']?>"/></li>
                         <li><a href="http://www.faltacopete.cl/agregar-botilleria" ><span class="nom-abatar">¡Hola! Don <?= $admin['nombre']?></span></a></li>
                          <li class="option-admin dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Opciones<b class="caret"></b></a>
                              <ul class="dropdown-menu">
<!--                                  <li><a href="http://www.faltacopete.cl/editar-informacion">Editar información</a></li>
                                  <li id="cambiarClave"><a href="#">Cambiar Contraseña</a></li>-->
                                  <li class="divider"></li>
                                  <!--<li class="dropdown-header">Nav header</li>-->
                                   <li><a href="http://www.faltacopete.cl/function/logout.php" id="salir"  >Salir</a></li>
                              </ul>
                        </li>
                    </ul> 
              <?php } ?>