<?php if(isset($_SESSION['id_boti'])){
                    $boti = new botilleria();
                    $boti = $boti->verPorId($_SESSION['id_boti']);
                    ?>
                    <!-- admin -->
                     <li class="menu-movil img-abatar-movil"><img class="img-abatar"src="http://www.faltacopete.cl/images/botillerias/<?= $boti['foto']?>"/></li>
                     <li class="menu-movil nom-abatar-movil"><a href="http://www.faltacopete.cl/home-admin" ><span class="nom-abatar"><?= $boti['nombre']?></span></a></li>
                     <li class="menu-movil"><a href="http://www.faltacopete.cl/home-admin">Editar mi oferta</a></li>
                     <li class="menu-movil"><a href="http://www.faltacopete.cl/editar-informacion">Editar información del local</a></li>
                     <li class="menu-movil"><a id="cambiarClave" href="#">Cambiar Contraseña</a></li>
                     <li class="menu-movil"><a href="http://www.faltacopete.cl/function/logout.php">Salir</a></li>

                    <!-- fin admin -->
               <?php }elseif(isset($_SESSION['id_admin'])){//sumer admin
                     $boti = new botilleria();
                     $admin = $boti->verAdminPorId($_SESSION['id_admin']);
                     ?>
                     <li class="menu-movil img-abatar-movil"><img class="img-abatar"src="http://www.faltacopete.cl/images/botillerias/<?= $admin['foto']?>"/></li>
                     <li class="menu-movil nom-abatar-movil"><a href="http://www.faltacopete.cl/agregar-botilleria" ><span class="nom-abatar"><?= $admin['nombre']?></span></a></li>
                     <li class="menu-movil"><a href="http://www.faltacopete.cl/function/logout.php">Salir</a></li>
               <?php }?>