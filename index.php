<?php 
    session_start();
    include_once 'function/place.php';
    date_default_timezone_set("Chile/Continental");   
    require_once 'DAL/connect_relacional.php';
    require_once 'DAL/botilleria.php';
?>
<!DOCTYPE html>
<html lang="en" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/">
  <head>
    <title><?= $page_title?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $page_description?>">
    <meta name="author" content="Diego José Molina González">
    <meta property="og:title" content="Faltacopete.cl - Cupones de Copete, GRATIS"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="http://faltacopete.cl"/>
    <meta property="og:image" content="http://faltacopete.cl/images/perfil-face.jpg"/>
    <meta property="og:site_name" content="Faltacopete.cl"/>
    <meta property="og:description"  content="El único sitio de descuentos para el copete que te permite generar cupones totalmente gratis." />
    <meta property="fb:admins" content="skumblue"/>
    <meta name="keywords" content="Botillerias en Santiago, Botillerias baratas, Promos en botillerias, Carretes, Promos de copete, Copete barato, Copete en Santiago, Delivery en copete, Delivery de copete en Santiago, Cupones en Santiago, Cupones de descuento en Santiago, Ofertas es Santiago"/>
    <meta name="description" content="Faltacopete.cl Cupones de copete gratis en Santiago. Cupones, promociones y ofertas para comprar copete en Santiago. Todos los locales con descuentos y cupones de copete en Santiago"/>
   
    <link rel="shortcut icon" type="image/png" href="/images/favicon.png">
    
    
    <!-- Custom styles for this template -->
    <link href="css/stylebase.css" rel="stylesheet">
    
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-1.7.2.min.js"></script>
    <script>
//        var device = navigator.userAgent
//        if (device.match(/Iphone/i)|| device.match(/Ipod/i)|| device.match(/Android/i)|| device.match(/J2ME/i)|| device.match(/BlackBerry/i)|| device.match(/iPhone|iPad|iPod/i)|| device.match(/Opera Mini/i)|| device.match(/IEMobile/i)|| device.match(/Mobile/i)|| device.match(/Windows Phone/i)|| device.match(/windows mobile/i)|| device.match(/windows ce/i)|| device.match(/webOS/i)|| device.match(/palm/i)|| device.match(/bada/i)|| device.match(/series60/i)|| device.match(/nokia/i)|| device.match(/symbian/i)|| device.match(/HTC/i))
//         { 
//        window.location = "http://www.m.faltacopete.cl";
//
//        }
    </script>
    

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
      <div id="fb-root"></div>
                        <div id="fb-root"></div>
                         <script>
                                (function(d, s, id) {
                              var js, fjs = d.getElementsByTagName(s)[0];
                              if (d.getElementById(id)) return;
                              js = d.createElement(s); js.id = id;
                              js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=1425476474356024";
                              fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));
                        </script>
    <?php include_once('sites/secciones/popup-inicio.php');?>   
     <div id="coverall">
            <div class="innercal">
                <div class="cerrar sprites"></div>
                <div id="caloader">
                    
                </div>
            </div>
     </div>
     <!-- Wrap all page content here -->
    <div id="wrap">
      <!-- Fixed navbar -->
      <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand enlace-logo" href="http://www.faltacopete.cl/home">
                <img title="Faltacopete.cl" class="logo-small" src="http://www.faltacopete.cl/images/logo.png"/>
            </a>
            
          </div>
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav"> 
              <div class="navbar-form navbar-left form-search" role="search">
                    <div class="form-group ">
                      <input name="q" id="search" type="text" class="form-control" placeholder="Busca cervezas, vodka, comuna, etc.">
                      <a href="#" alt="Buscador Faltacopete.cl" title="Buscador Faltacopete.cl" id="btn-search" class="sprites"></a>
                    </div>
              </div>             
              
             <?php if($page_site == 'home'){?>
                <li class="active">
                    <a class="menu" href="http://www.faltacopete.cl/home">Inicio <label class="active-menu"></label></a>
                </li>
              <?php }else{?>
                 <li>
                    <a class="menu" href="http://www.faltacopete.cl/home">Inicio</a>
                </li>
              <?php }?>
                
               <?php if($page_site == 'contacto'){?>  
                    <li class="active">
                        <a class="menu" href="http://www.faltacopete.cl/contacto">Contacto <label class="active-menu"></label></a>
                    </li>
               <?php }else{?>
                    <li>
                       <a class="menu" href="http://www.faltacopete.cl/contacto">Contacto</a>
                   </li>
              <?php }?>
                   <li>
                       <a id="como-funciona" class="menu" href="#">¿Cómo funciona?</a>
                   </li>
                
 
                    
                     <?php include_once('sites/secciones/nav-admin.php'); //menu admin móvil?>
                 
            </ul>     
              <?php if(!isset($_SESSION['id_boti']) && !isset($_SESSION['id_admin'])){ //cuando hay login no lo muestra?>
                    <div id="face-nav" class="fb-like" data-href="https://www.facebook.com/faltacopetechile" 
                         data-layout="button_count" data-action="like" 
                         data-show-faces="true" data-share="false"></div>
              <?php } ?>
              
                   <?php include_once('sites/secciones/nav-adminpc.php'); //menu admin pc?>                  
                    
          </div><!--/.nav-collapse -->
        </div>
      </div>
      <input type="hidden" value="<?= $_SESSION['id_boti']?>" id="id_boti"/>
    </div> 
     <!-- End wrap -->
      
    <div class="container container-main">
       
        <?php include_once('sites/'.$page_site.'.php'); ?> 
        <footer>
            <div class="texto texto1">© Falta Copete <?= date("Y")?> Todos los derechos reservados</div>
            <div class="texto texto2"><a href="http://www.faltacopete.cl/login">Ingreso de locales</a></div>
        </footer>
        
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    
     <script type="text/javascript" src="js/script.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script type="text/javascript" src="js/facebookgraph.js"></script>
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-48214059-1', 'faltacopete.cl');
        ga('send', 'pageview');

    </script>
  </body>
</html>
