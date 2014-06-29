<?php
    require_once '../DAL/connect_relacional.php';
    require_once '../DAL/botilleria.php';
    require_once '../function/escalar.php';
    require_once '../function/allfunction.php';
    if(isset($_REQUEST['guardaroferta'])){   
            if(trim($_REQUEST['nom-oferta1']) == '' || trim($_REQUEST['nom-oferta2']) == '' ||
               trim($_REQUEST['precio-real']) == '' || trim($_REQUEST['precio-oferta']) == '' ||
               trim($_REQUEST['descripcion-oferta']) == ''){
                header("location:http://www.faltacopete.cl/nueva-oferta");
            }else{
                ///////////
                $botilleria = new botilleria();  
                $rutasFotos = array();
                $re1 = true;
                //VALIDAR QUE SEA FOTO
                if($_FILES['img-oferta']['name'] != ''){
                    $exito1 = subir($_FILES['img-oferta']['name'], $_FILES['img-oferta']['tmp_name']);
                }
                $idBoti = $_REQUEST['id_boti'];
                $botilleria->editarVigenciasDeOfertas($idBoti);  

                $nom1 = safeForDB($_REQUEST['nom-oferta1']);
                $nom2 = safeForDB($_REQUEST['nom-oferta2']);

                $precioReal = safeForDB($_REQUEST['precio-real']);
                $precio_oferta = safeForDB($_REQUEST['precio-oferta']);
                $texto = safeForDB($_REQUEST['texto-oferta']);
                $condiciones = trim($_REQUEST['condiciones-oferta']);
                $detalles = trim($_REQUEST['descripcion-oferta']);
                $renovado = 0;
                $cantGenerado = 0;
                $fechaIngreso = date('Y-m-d H:i:s');//2014-01-22 00:00:00
                
                //cuando se pague
    //            $fechaCaducidad = strtotime('+7 day', strtotime($fechaIngreso));
    //            $fechaCaducidad = date('Y-m-d H:i:s', $fechaCaducidad);
                //fin cuando se pague

                $fechaCaducidad = strtotime('+56 day', strtotime($fechaIngreso));
                $fechaCaducidad = date('Y-m-d H:i:s', $fechaCaducidad);
                $vigente = 1;
                $foto = $exito1['fotoGr'];
                $foto = safeForDB($foto);
                $guardar = 0;
                
                $formaPago = $_REQUEST['forma_pago'];
                $despacho = $_REQUEST['despacho'];
                if($despacho){
                    $despacho = 1;
                }else{
                    $despacho = 0;
                }
                $recargo = '0';
                $areas = $_REQUEST['areas'];
                $tipoimagen = $_REQUEST['tipo_imagen'];
                $guardar = $botilleria->insertarOferta($nom1, $nom2, $precioReal, $precio_oferta, $texto, $condiciones, 
                                                        $detalles, $idBoti, $renovado, $cantGenerado, $fechaIngreso, 
                                                        $fechaCaducidad, $fechaIngreso, $vigente, $foto,
                                                        $formaPago, $despacho, $recargo, $areas, $tipoimagen);
            if($guardar==1){
                header("location:http://www.faltacopete.cl/home-admin");
            }else{
                 header("location:http://www.google.cl");
            }
        }
    }
    if(isset($_REQUEST['editarOferta'])){
        if(trim($_REQUEST['nom-oferta1']) == '' || trim($_REQUEST['nom-oferta2']) == '' ||
               trim($_REQUEST['precio-real']) == '' || trim($_REQUEST['precio-oferta']) == '' ||
               trim($_REQUEST['descripcion-oferta']) == ''){
                header("location:http://www.faltacopete.cl/editar-oferta/".$_REQUEST['id']);
         }else{
                $botilleria = new botilleria();  
                $rutasFotos = array();
                $re1 = true;
                $foto = -1;
                //VALIDAR QUE SEA FOTO
                if($_FILES['img-oferta']['name'] != '' ){
                    $exito1 = subir($_FILES['img-oferta']['name'], $_FILES['img-oferta']['tmp_name']);
                    $foto = $exito1['fotoGr'];
                }
                $id = $_REQUEST['id'];
                $nom1 = trim($_REQUEST['nom-oferta1']);
                $nom2 = trim($_REQUEST['nom-oferta2']);
                $precioReal = trim($_REQUEST['precio-real']);
                $precio_oferta = trim($_REQUEST['precio-oferta']);
                $texto = trim($_REQUEST['texto-oferta']);
                $condiciones = trim($_REQUEST['condiciones-oferta']);
                $detalles = trim($_REQUEST['descripcion-oferta']);
                $formaPago = $_REQUEST['forma_pago'];
                $despacho = $_REQUEST['despacho'];
                $tipoimagen = $_REQUEST['tipo_imagen'];
                if($despacho){
                    $despacho = 1;
                }else{
                    $despacho = 0;
                }
                $recargo = '0';
                $areas = $_REQUEST['areas'];
                $editar = 0;
                $editar = $botilleria->editarOferta($id, $nom1, $nom2, $precioReal, $precio_oferta,
                                                    $texto, $condiciones, $detalles, $foto, 
                                                    $formaPago, $despacho, $recargo, $areas, $tipoimagen);


            if($editar==1){
                header("location:http://www.faltacopete.cl/home-admin");
            }else{
                 header("location:http://www.google.cl");
            }
        }
    }
    if(isset($_REQUEST['editarBoti'])){      
         if(trim($_REQUEST['nombre-botilleria']) == '' || trim($_REQUEST['comuna']) == '' ||
               trim($_REQUEST['direccion-botilleria']) == '' || trim($_REQUEST['horario-botilleria']) == ''){
                header("location:http://www.faltacopete.cl/editar-informacion/".$_REQUEST['id']);
            }else{
                $botilleria = new botilleria();  
                $rutasFotos = array();
                $re1 = true;
                $foto = -1;
                //VALIDAR QUE SEA FOTO
                if($_FILES['img-botilleria']['name'] != '' ){
                    $exito1 = subirBotilleria($_FILES['img-botilleria']['name'], $_FILES['img-botilleria']['tmp_name']);
                    $foto = $exito1['fotoGr'];
                }
                //datos
                $id = $_REQUEST['id'];
                $nombre = trim($_REQUEST['nombre-botilleria']);
                $idComuna = trim($_REQUEST['comuna']);
                $direccion = trim($_REQUEST['direccion-botilleria']);
                $telefono1 = trim($_REQUEST['telefono1-botilleria']);
                $telefono2 = trim($_REQUEST['telefono2-botilleria']);
                $horario = trim($_REQUEST['horario-botilleria']);
                $lat = $_REQUEST['lat'];
                $lng = $_REQUEST['lng'];
                $editar = 0;
                $editar = $botilleria->editar($id, $nombre, $direccion, $lat, $lng, 
                                              $telefono1, $telefono2, $horario, $idComuna, $foto);
            if($editar==1){
                header("location:http://www.faltacopete.cl/home-admin");
            }else{
                 header("location:http://www.google.cl");
            }
       }
    }
    if(isset($_REQUEST['agregarBoti'])){      
         if(trim($_REQUEST['nombre-botilleria']) == '' || trim($_REQUEST['comuna']) == '' ||
               trim($_REQUEST['direccion-botilleria']) == '' || trim($_REQUEST['horario-botilleria']) == ''){
                header("location:http://www.faltacopete.cl/agregar-botilleria");
            }else{
                $botilleria = new botilleria();  
                $rutasFotos = array();
                $re1 = true;
                $foto = -1;
                //VALIDAR QUE SEA FOTO
                if($_FILES['img-botilleria']['name'] != '' ){
                    $exito1 = subirBotilleria($_FILES['img-botilleria']['name'], $_FILES['img-botilleria']['tmp_name']);
                    $foto = $exito1['fotoGr'];
                }
                $usuario = trim($_REQUEST['usuario-botilleria']);
                $clave = 'abc123';
                $nombre = trim($_REQUEST['nombre-botilleria']);
                $idComuna = trim($_REQUEST['comuna']);
                $direccion = trim($_REQUEST['direccion-botilleria']);
                $telefono1 = trim($_REQUEST['telefono1-botilleria']);
                $telefono2 = trim($_REQUEST['telefono2-botilleria']);
                $horario = trim($_REQUEST['horario-botilleria']);
                $email = trim($_REQUEST['email-botilleria']);
                $lat = $_REQUEST['lat'];
                $lng = $_REQUEST['lng'];
                $guardar = 0;
                $guardar = $botilleria->insertar($nombre, $usuario, $clave, $direccion, $lat, $lng, 
                            $telefono1, $telefono2, $horario, $idComuna, $email, $foto);
            if($guardar==1){
                //mail
                    require_once '../function/send.php';
                    $cuerpo = mailBienvenida($nombre, $usuario, $clave);
                    email($email,  'Faltacopete.cl - Bienvenido',$cuerpo);
                //fin mail
                header("location:http://www.faltacopete.cl/home-admin");
            }else{
                 header("location:http://www.google.cl");
            }
       }
    }
    function subir($name, $temp){
        
        $re = false;
        $resultEscalar = false;
        $resultEscalarGr = false;
        $nameconcate = '';
        //$userid = $_SESSION['userid'];
        
        $partes = explode(".", $name);
        $ext = $partes[count($partes) - 1 ];       
        $fec = date('d-m-y');
        $partesfecha = explode("-", $fec);
        $fec = $partesfecha[2].$partesfecha[1].$partesfecha[0];
        $hor = time();
        $ran = rand(0, 100);

        $nameconcate = $fec.'-'.$hor.'-'.$ran.'_pe.'.$ext;
        $nameconcateGr = $fec.'-'.$hor.'-'.$ran.'_gr.'.$ext;
    //    $url = $urluser."/".$nameconcate;

        $fotoRedimensionar = "../images/pruebas/".$nameconcate;
        $fotoFinalPq = "../images/ofertas/".$nameconcate;
        $fotoFinalGr = "../images/ofertas/".$nameconcateGr;

        $re = move_uploaded_file($temp,$fotoRedimensionar);//pego la foto de prueba
        //$fotoFinalSmall = "../fotos/dentistas/small_".$nombre_foto;
        if($re){//si copio correctamente
           $resultEscalarGr = cuadrar($fotoRedimensionar, $fotoFinalGr, 400, 400); //pequeña
//           $resultEscalarGr = escalar($fotoRedimensionar, $fotoFinalGr, 400, 300); //grande
           //ELIMINAR LA FOTO ANTIGUA 
           unlink($fotoRedimensionar);
           
           //probar
//           $resultEscalarGr = cuadrar($fotoRedimensionar, $fotoFinalGr, 400, 300); //pequeña
           //fin probar
        }

        chmod($fotoFinalPq, 0755);
        chmod($fotoFinalGr, 0755);
        $resp = array("re"=>$re,"fotoGr"=>$nameconcateGr, "fotoPe"=>$nameconcate);
        return $resp;
    }
     function subirBotilleria($name, $temp){
      
        $re = false;
        $resultEscalar = false;
        $resultEscalarGr = false;
        $nameconcate = '';
        //$userid = $_SESSION['userid'];
        
        $partes = explode(".", $name);
        $ext = $partes[count($partes) - 1 ];       
        $fec = date('d-m-y');
        $partesfecha = explode("-", $fec);
        $fec = $partesfecha[2].$partesfecha[1].$partesfecha[0];
        $hor = time();
        $ran = rand(0, 100);

        $nameconcate = $fec.'-'.$hor.'-'.$ran.'_pe.'.$ext;
        $nameconcateGr = $fec.'-'.$hor.'-'.$ran.'_gr.'.$ext;
    //    $url = $urluser."/".$nameconcate;

        $fotoRedimensionar = "../images/pruebas/".$nameconcate;
        $fotoFinalPq = "../images/botillerias/".$nameconcate;
        $fotoFinalGr = "../images/botillerias/".$nameconcateGr;
        
        $re = copy($temp,$fotoRedimensionar);
       // $re = move_uploaded_file($temp,$fotoRedimensionar);//pego la foto de prueba
        //$fotoFinalSmall = "../fotos/dentistas/small_".$nombre_foto;
        if($re){//si copio correctamente
          $resultEscalar = cuadrar($fotoRedimensionar, $fotoFinalGr, 180, 180); //pequeña
         // $resultEscalarGr = escalar($fotoRedimensionar, $fotoFinalGr, 180, 110); //grande
           //ELIMINAR LA FOTO ANTIGUA 
           unlink($fotoRedimensionar);
        }

        chmod($fotoFinalPq, 0755);
        chmod($fotoFinalGr, 0755);
        $resp = array("re"=>$re,"fotoGr"=>$nameconcateGr, "fotoPe"=>$nameconcate);
        return $resp;
    }
?>