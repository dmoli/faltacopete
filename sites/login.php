<?php
require_once 'function/allfunction.php';
if(isset($_REQUEST['login']))
{
        $usuario = safeForDB($_REQUEST['usuario']);
        $clave = safeForDB($_REQUEST['clave']);   
        $botilleria = new botilleria();
        $encontrado = $botilleria->login($usuario, $clave);
        if($encontrado != null){
                    $_SESSION['id_boti'] = $encontrado['id'];
                    $_SESSION['nombre_boti'] = $encontrado['nombre'];
                    $_SESSION["ultimoAcceso"] = time(); 
                    header("location:http://www.faltacopete.cl/home-admin");
        }else{
            $encontrado = $botilleria->loginAdmin($usuario, $clave);
            if($encontrado != null){
                header("location:http://www.faltacopete.cl/agregar-botilleria");
            }else{
                header("location:http://www.faltacopete.cl/login");
            }
        }
       
}
    if(isset($_SESSION['id_admin'])){
        header("location:http://faltacopete.cl/agregar-botilleria");
     }?>
<div <?= $page_class ?>>
     
      <div class="row">
        <div class="col-md-4">
           <?php if(!isset($_SESSION['id_boti'])){?>
            <form method="POST" class="form-signin" role="form" action="http://www.faltacopete.cl/login">
                    <h3 class="form-signin-heading">Inicia sesión <?=  $_SESSION['id_boti'];?></h3>
                    <!--<img class="logo-principal" src="images/men-guard.png"/>-->
                    <input placeholder="Nombre de usuario" id="usuario" name="usuario" type="text" class="form-control" placeholder="Rut" required autofocus>
                    <input placeholder="*****" name="clave" type="password" class="form-control" placeholder="Clave" required>
                   
                    
                    <button name="login" class="btn btn-lg btn-success btn-block" type="submit">Iniciar sesión</button>
                     <a href="#" id="olvide-clave">Olvidé contraseña</a>
               </form>
         <?php }  else {
                     header("location:http://faltacopete.cl/home-admin");       
             
             }?>
        </div>

   
      </div>
     
     
</div>