<?php
  $place = empty($_GET['place']) ? 'home' : $_GET['place'];
  $page_description = "Sobran carretes FALTA COPETE";
  switch ($place){
      case 'landing': $page_title = 'Landing - Page';
                   $page_site = 'landing';
                   $page_class = 'landing';
                   break;
      case 'contacto': $page_title = 'Faltacopete.cl - Contacto';
                   $page_site = 'contacto';
                   $page_class = 'contacto';
                   break;
      case 'home': $page_title = 'Faltacopete.cl - Sobran carretes FALTA COPETE';
                   $page_site = 'home';
                   $page_class = 'home';
                   break;
      case 'cupon': 
          
                   $page_title = 'Faltacopete.cl - Perfil de Cupón '.$_REQUEST['id'];
                   $page_site = 'perfil-cupon';
                   $page_class = 'perfil-cupon';
                   break;
      case 'generar-cupon': $page_title = 'Faltacopete.cl - Sobran carretes FALTA COPETE';
                   $page_site = 'generar-cupon';
                   $page_class = 'generar-cupon';
                   break;
      case 'login': $page_title = 'Faltacopete.cl - Login';
                   $page_site = 'login';
                   $page_class = 'login';
                   break;
      case 'home-admin': $page_title = 'Faltacopete.cl - Bienvenido';
                   $page_site = 'home-admin';
                   $page_class = 'home-admin';
                   break;
       case 'agregar-botilleria': $page_title = 'Faltacopete.cl - Administración';
                   $page_site = 'agregar-botilleria';
                   $page_class = 'editar-informacion';
                   break;
      case 'editar-oferta': $page_title = 'Faltacopete.cl - Editar oferta';
                   $page_site = 'editar-oferta';
                   $page_class = 'editar-oferta';
                   break;
      case 'nueva-oferta': $page_title = 'Faltacopete.cl - Nueva oferta';
                   $page_site = 'nueva-oferta';
                   $page_class = 'editar-oferta';
                   break;
      case 'editar-informacion': $page_title = 'Faltacopete.cl - Editar información';
                   $page_site = 'editar-informacion';
                   $page_class = 'editar-informacion';
                   break;
      case 'inicio': $page_title = 'Faltacopete.cl - Sobran carretes FALTA COPETE';
                   $page_site = 'inicio';
                   $page_class = 'inicio';
                   break;
      case 'search': if( isset($_POST['direccion']) != '' && isset($_POST['evento'] ) != '' ){
                    $page_title = 'Search';
                    $page_site = 'search';
                    $page_class= 'search';
                    }else{
                        header('location: /test/');
                    }
                    break;

      default : $page_title = '404';
                $page_site = '404';
                
  }
  
  $page_class = empty($page_class) ? '' : 'class="'.$page_class.'"';
  
