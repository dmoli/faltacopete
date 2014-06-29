<?php
//    require_once 'relacional/connect_relacional.php';
     require_once 'PasswordHash.php';
class botilleria {
    private $conect;
    function __construct() {
        $this->conect = new connect_relacional();
    }
    function __destruct() {
        $this->conect->desconectarse();
    }
    /*admin*/
    public function loginAdmin($usuario, $pass)
    {
         if($this->conect->conectarse()){
            $hasher = new PasswordHash(8, FALSE);
           // $passEncript = $hasher->HashPassword($pass);
            $passEncript = $pass;//sacar
            $query = "SELECT * FROM admin WHERE usuario = '$usuario' AND clave='$passEncript'";
            $result = mysql_query($query);
            $admin = array();
            while($re = mysql_fetch_array($result)){
                $_SESSION['id_admin'] = $re[0];
                $_SESSION['nombre_admin'] = $re[1];
                $_SESSION["ultimoAcceso"] = time();
                $admin = array("id"=>$re[0],
                                      "nombre"=>$re[1], 
                                      "usuario"=>$re[2],
                                      "clave"=>$re[3],
                                      "ultimo_acceso"=>$re[4],
                                      "foto"=>$re[5]
                                    );
            }
            return $admin;
         }
    }
     public function verAdminPorId($id){
        if($this->conect->conectarse()){
            $query = "SELECT * FROM admin WHERE id=$id";
            $result = mysql_query($query);
            $botilleria = array();
            while($re = mysql_fetch_array($result)){
                $botilleria = array("id"=>$re[0],
                                      "nombre"=>$re[1], 
                                      "usuario"=>$re[2],
                                      "clave"=>$re[3],
                                      "ultimo_acceso"=>$re[4],
                                      "foto"=>$re[5]
                                    );
            }
            return $botilleria;
        }else{
            return -5;
        }
    }
    /*botillerias*/
    public function login($usuario, $pass)
    {
         if($this->conect->conectarse()){
            $query = "SELECT * FROM botilleria WHERE usuario = '$usuario'";
            $result = mysql_query($query);
            $botilleria = array();
            while($re = mysql_fetch_array($result)){
                $hasher = new PasswordHash(8, FALSE);
                if($hasher->CheckPassword($pass, $re[3])) {//clave plana, hash
                    $botilleria = array("id"=>$re[0],
                                          "nombre"=>$re[1], 
                                          "usuario"=>$re[2],
                                          "clave"=>$re[3],
                                          "direccion"=>$re[4],
                                          "lat"=>$re[5], 
                                          "lng"=>$re[6],
                                          "telefono1"=>$re[7],
                                          "telefono2"=>$re[8],
                                          "horario"=>$re[9],
                                          "id_comuna"=>$re[10],
                                          "foto"=>$re[11]
                                        );
                                        
                }
            }
            return $botilleria;
         }
    }
    public function insertar($nombre, $usuario, $clave, $direccion, $lat, $lng, $telefono1, $telefono2,
                             $horario, $idComuna, $email, $foto){
        if($this->conect->conectarse()){
            $hasher = new PasswordHash(8, FALSE);
            $passEncript = $hasher->HashPassword($clave);
            $query = "INSERT INTO botilleria VALUES('', '$nombre', '$usuario', '$passEncript', '$direccion', '$lat', '$lng', 
                                                 '$telefono1', '$telefono2', '$horario', '$idComuna', '$foto', '$email') ";
            $re = mysql_query($query);
            return $re;
        }else{
            return -5;
        }
    }
    public function eliminar($id){
        if($this->conect->conectarse()){
            $query = "DELETE FROM botilleria WHERE id = $id ";
            $re = mysql_query($query);
            return $re;
        }else{
            return -5;
        }
    }
    public function editar($id, $nombre, $direccion, $lat, $lng, $telefono1, $telefono2,
                             $horario, $idComuna, $foto){
        if($this->conect->conectarse()){
            $query = "UPDATE botilleria SET nombre = '$nombre',direccion = '$direccion',
                                            lat = '$lat', lng = '$lng', telefono1 = '$telefono1', telefono2 = '$telefono2',
                                            horario = '$horario', id_comuna = $idComuna
                      WHERE id = '$id'";
            if($foto != -1)//agregó una nueva foto
            {
                $this->cambiarFotoBoti($id, $foto);
            }
            $re = mysql_query($query);
            
            return $re;
        }else{
            return -5;
        }
    }
     public function cambiarFotoBoti($id, $nuevaFoto){
        if($this->conect->conectarse()){
            $query1 = "SELECT id, foto FROM botilleria WHERE id=$id";
            $result = mysql_query($query1);
            $boti = array();
            while($re = mysql_fetch_array($result)){
                $boti = array("id"=>$re[0],
                                "foto"=>$re[1]
                                    );
            }
            //eliminar foto antigua AL SUBIR AL SERVIDOR PROBAR NUEVAMENTE, X AHORA NO ELIMINA
            unlink('http://faltacopete.cl/images/botillerias/'.$boti['foto']);
            $query = "UPDATE botilleria SET foto='$nuevaFoto'
                      WHERE id = '$id'";
            $re = mysql_query($query);
            
            return $re;
        }else{
            return -5;
        }
    }
    public function verPorId($id){
        if($this->conect->conectarse()){
            $query = "SELECT * FROM botilleria WHERE id=$id";
            $result = mysql_query($query);
            $botilleria = array();
            while($re = mysql_fetch_array($result)){
                $botilleria = array("id"=>$re[0],
                                      "nombre"=>$re[1], 
                                      "usuario"=>$re[2],
                                      "clave"=>$re[3],
                                      "direccion"=>$re[4],
                                      "lat"=>$re[5], 
                                      "lng"=>$re[6],
                                      "telefono1"=>$re[7],
                                      "telefono2"=>$re[8],
                                      "horario"=>$re[9],
                                      "id_comuna"=>$re[10],
                                      "foto"=>$re[11]
                                    );
            }
            return $botilleria;
        }else{
            return -5;
        }
    }
    public function verPorEmailoUsuario($usuario){
        if($this->conect->conectarse()){
            $query = "SELECT * FROM botilleria WHERE usuario= '$usuario' OR email = '$usuario'";
            $result = mysql_query($query);
            $botilleria = array();
            while($re = mysql_fetch_array($result)){
                $botilleria = array("id"=>$re[0],
                                      "nombre"=>$re[1], 
                                      "usuario"=>$re[2],
                                      "clave"=>$re[3],
                                      "direccion"=>$re[4],
                                      "lat"=>$re[5], 
                                      "lng"=>$re[6],
                                      "telefono1"=>$re[7],
                                      "telefono2"=>$re[8],
                                      "horario"=>$re[9],
                                      "id_comuna"=>$re[10],
                                      "foto"=>$re[11],
                                      "email"=>$re[12]
                                    );
            }
            return $botilleria;
        }else{
            return -5;
        }
    }
   
    public function recuperarClave($id){
        if($this->conect->conectarse()){            
            $hor = time();
            $ran = rand(0, 10000);
            $nuevaClave = $ran;

            $hasher = new PasswordHash(8, FALSE);
            $passEncript = $hasher->HashPassword($nuevaClave);
           
            $query = "UPDATE botilleria SET clave = '$passEncript' WHERE id=$id";
            $result = mysql_query($query);
            return $nuevaClave;
        }else{
            return -5;
        }
    }
    public function comprobarClave($id, $clave){
        if($this->conect->conectarse()){
            $hasher = new PasswordHash(8, FALSE);
            $query = "SELECT * FROM botilleria WHERE id='$id'";
            $result = mysql_query($query);
            $botilleria = -1;
            while($re = mysql_fetch_array($result)){
                if($hasher->CheckPassword($clave, $re[3])) {//clave plana, hash
                    $botilleria = 1;
                }
            }
            return $botilleria;
        }else{
            return -5;
        }
    }
    public function cambiarClave($id, $clave){
        if($this->conect->conectarse()){
            $hasher = new PasswordHash(8, FALSE);
            $passEncript = $hasher->HashPassword($clave);
            $query = "UPDATE botilleria SET clave = '$passEncript' WHERE id=$id";
            $result = mysql_query($query);
            return $result;
        }else{
            return -5;
        }
    }
    /*fin botillerias*/
    /*ofertas*/
    public function insertarOferta($nom1, $nom2, $precioReal, $precio_oferta, $texto, $condiciones, $detalles, $idBoti,
                             $renovado, $cantGenerado, $fechaIngreso, $fechaCaducidad, $fechaRevado, $vigente, $foto,
                             $formaPago, $despacho, $recargo, $areas, $tipoImagen){
        if($this->conect->conectarse()){
            $query = "INSERT INTO oferta VALUES('', '$nom1', '$nom2', '$precioReal', '$precio_oferta', '$texto',
                                                    '$condiciones', '$detalles', '$idBoti', '$renovado', '$cantGenerado', 
                                                    '$fechaIngreso', '$fechaCaducidad', '$fechaRevado', '$vigente', '$foto', 2,
                                                    '$formaPago', '$despacho', '$recargo', '$areas', '$tipoImagen') ";
            $re = mysql_query($query);
            $hoy = $this->hoy();
            $query4 = "INSERT INTO vigencia_gratis VALUES('', $idBoti, '$hoy','$fechaCaducidad' )";
            $re4 = mysql_query($query4);
            return $re;
        }else{
            return -5;
        }
    }
    //cuando se page el numero despues de $vigente debe ser 1 (PENDIENTE)
    public function eliminarOferta($id){
        if($this->conect->conectarse()){
            $query = "DELETE FROM oferta WHERE id = $id ";
            $re = mysql_query($query);
            return $re;
        }else{
            return -5;
        }
    }

    public function editarOferta($id, $nom1, $nom2, $precioReal, $precio_oferta,
                                 $texto, $condiciones, $detalles, $foto,
                                 $formaPago, $despacho, $recargo, $areas, $tipoimagen){
        if($this->conect->conectarse()){
            $query = "UPDATE oferta SET nombre='$nom1', nombre2='$nom2', precio_real='$precioReal',  
                                        precio_oferta='$precio_oferta', texto='$texto', condiciones='$condiciones', 
                                        detalles = '$detalles', forma_pago = '$formaPago', despacho = '$despacho', 
                                        recargo = '$recargo', areas = '$areas', tipo_imagen = '$tipoimagen'
                      WHERE id = $id";
            if($foto != -1)//agregó una nueva foto
            {
                $this->cambiarFoto_Oferta($id, $foto);
            }
            $re = mysql_query($query);
            
            return $re;
        }else{
            return -5;
        }
    }
    public function cambiarFoto_Oferta($id, $nuevaFoto){
        if($this->conect->conectarse()){
            $query1 = "SELECT id, foto FROM oferta WHERE id=$id";
            $result = mysql_query($query1);
            $oferta = array();
            while($re = mysql_fetch_array($result)){
                $oferta = array("id"=>$re[0],
                                "foto"=>$re[1]
                                    );
            }
            //eliminar foto antigua AL SUBIR AL SERVIDOR PROBAR NUEVAMENTE, X AHORA NO ELIMINA
            unlink('http://www.faltacopete.cl/images/ofertas/'.$oferta['foto']);
            $query = "UPDATE oferta SET foto='$nuevaFoto'
                      WHERE id = '$id'";
            $re = mysql_query($query);
            
            return $re;
        }else{
            return -5;
        }
    }
    public function verOfertaPorId($id){
        if($this->conect->conectarse()){
            $query = "SELECT * FROM oferta WHERE id=$id";
            $result = mysql_query($query);
            $oferta = array();
            while($re = mysql_fetch_array($result)){
                $oferta = array("id"=>$re[0],
                                      "nombre"=>$re[1], 
                                      "nombre2"=>$re[2],
                                      "precio_real"=>$re[3],
                                      "precio_oferta"=>$re[4],
                                      "texto"=>$re[5],
                                      "condiciones"=>$re[6],
                                      "detalles"=>$re[7], 
                                      "id_boti"=>$re[8],
                                      "renovado"=>$re[9],
                                      "cant_generado"=>$re[10],
                                      "fecha_ingreso"=>$re[11],
                                      "fecha_caducidad"=>$re[12],
                                      "fecha_renovado"=>$re[13],
                                      "vigente"=>$re[14],
                                      "foto"=>$re[15],
                                      "estado"=>$re[16],    
                                      "forma_pago"=>$re[17],
                                      "despacho"=>$re[18],
                                      "recargo"=>$re[19],
                                      "areas"=>$re[20],
                                      "tipo_imagen"=>$re[21]
                                    );
            }
            return $oferta;
        }else{
            return -5;
        }
    }
     public function buscador($q){
        if($this->conect->conectarse()){
            $count = count(explode(" ", $q));
            if($count == 1){
             $query = "SELECT * FROM oferta
                      WHERE nombre LIKE '%".$q."%' OR
                            nombre2 LIKE '%".$q."%' OR
                            texto LIKE '%".$q."%' OR
                            detalles LIKE '%".$q."%' ";
            }else{
                $query = "SELECT *, MATCH (nombre, nombre2, texto, detalles) 
                          AGAINST ('$q') as relevancia
                          FROM oferta
                          WHERE MATCH (nombre, nombre2, texto, detalles) 
                          AGAINST ('$q')
                          ORDER BY relevancia";
            }
            $result = mysql_query($query);
            $oferta = array();
            while($re = mysql_fetch_array($result)){
                $oferta[] = array("id"=>$re[0],
                                      "nombre"=>$re[1], 
                                      "nombre2"=>$re[2],
                                      "precio_real"=>$re[3],
                                      "precio_oferta"=>$re[4],
                                      "texto"=>$re[5],
                                      "condiciones"=>$re[6],
                                      "detalles"=>$re[7], 
                                      "id_boti"=>$re[8],
                                      "renovado"=>$re[9],
                                      "cant_generado"=>$re[10],
                                      "fecha_ingreso"=>$re[11],
                                      "fecha_caducidad"=>$re[12],
                                      "fecha_renovado"=>$re[13],
                                      "vigente"=>$re[14],
                                      "foto"=>$re[15]
                                    );
            }
            return $oferta;
        }else{
            return -5;
        }
    }
    public function buscadorPorComuna($idComuna){
        if($this->conect->conectarse()){  
             $query = "SELECT * FROM oferta
                      WHERE id_boti in (SELECT id FROM botilleria
                                        WHERE id_comuna = '$idComuna')";
            
            $result = mysql_query($query);
            $oferta = array();
            while($re = mysql_fetch_array($result)){
                $oferta[] = array("id"=>$re[0],
                                      "nombre"=>$re[1], 
                                      "nombre2"=>$re[2],
                                      "precio_real"=>$re[3],
                                      "precio_oferta"=>$re[4],
                                      "texto"=>$re[5],
                                      "condiciones"=>$re[6],
                                      "detalles"=>$re[7], 
                                      "id_boti"=>$re[8],
                                      "renovado"=>$re[9],
                                      "cant_generado"=>$re[10],
                                      "fecha_ingreso"=>$re[11],
                                      "fecha_caducidad"=>$re[12],
                                      "fecha_renovado"=>$re[13],
                                      "vigente"=>$re[14],
                                      "foto"=>$re[15]
                                    );
            }
            return $oferta;
        }else{
            return -5;
        }
    }
    public function verOfertaVigente($idBoti){
        if($this->conect->conectarse()){
            $query = "SELECT * FROM oferta WHERE vigente = 1 AND 
                                                 id_boti = $idBoti";
            $result = mysql_query($query);
            $oferta = array();
            while($re = mysql_fetch_array($result)){
               $oferta = array("id"=>$re[0],
                                      "nombre"=>$re[1], 
                                      "nombre2"=>$re[2],
                                      "precio_real"=>$re[3],
                                      "precio_oferta"=>$re[4],
                                      "texto"=>$re[5],
                                      "condiciones"=>$re[6],
                                      "detalles"=>$re[7], 
                                      "id_boti"=>$re[8],
                                      "renovado"=>$re[9],
                                      "cant_generado"=>$re[10],
                                      "fecha_ingreso"=>$re[11],
                                      "fecha_caducidad"=>$re[12],
                                      "fecha_renovado"=>$re[13],
                                      "vigente"=>$re[14],
                                      "foto"=>$re[15],
                                      "estado"=>$re[16]
                                    );
            }
            return $oferta;
        }else{
            return -5;
        }
    }
   
     public function verOfertasVigentes(){
        if($this->conect->conectarse()){
            $hoy = $this->hoy();
            $query = "SELECT * FROM oferta WHERE vigente = 1 AND 
                                                 estado <> 1 AND 
                                                 fecha_caducidad >= '$hoy'";
            $result = mysql_query($query);
            $oferta = array();
            while($re = mysql_fetch_array($result)){
               $oferta[] = array("id"=>$re[0],
                                      "nombre"=>$re[1], 
                                      "nombre2"=>$re[2],
                                      "precio_real"=>$re[3],
                                      "precio_oferta"=>$re[4],
                                      "texto"=>$re[5],
                                      "condiciones"=>$re[6],
                                      "detalles"=>$re[7], 
                                      "id_boti"=>$re[8],
                                      "renovado"=>$re[9],
                                      "cant_generado"=>$re[10],
                                      "fecha_ingreso"=>$re[11],
                                      "fecha_caducidad"=>$re[12],
                                      "fecha_renovado"=>$re[13],
                                      "vigente"=>$re[14],
                                      "foto"=>$re[15]
                                    );
            }
            return $oferta;
        }else{
            return -5;
        }
    }         
    public function insertarSolicitud($idBotilleria, $idOferta){
        if($this->conect->conectarse()){
            $hoy = $this->hoy();
            $query = "INSERT INTO solicitud_oferta VALUES('', '$idBotilleria', '$idOferta', '$hoy') ";
            $re = mysql_query($query);
            
            $query3 = "UPDATE oferta SET estado = 1, renovado = renovado +1 WHERE id='$idOferta'";
            $re3 = mysql_query($query3);
            
            
//        CUANDO LA BOTI REACTIVE LA OFERTA: PENDIENTE:
//            //todas sus cupones generados pasan su estado autorizado a 0
//            $query3 = "UPDATE cupon SET autorizado = 0, renovado = renovado +1 WHERE id='$idOferta'";
//            $re3 = mysql_query($query3);

            
            //HACER POR SUPER ADMIN
                    //$fechaCaducidad = strtotime('+7 day', strtotime($hoy));
                    $fechaCaducidad = strtotime('+56 day', strtotime($hoy));
                    $fechaCaducidad = date('Y-m-d H:i:s', $fechaCaducidad);
                    $query2 = "UPDATE oferta SET fecha_renovado = '$hoy', fecha_caducidad='$fechaCaducidad', renovado = 1
                               WHERE id='$idOferta'";
                    $re2 = mysql_query($query2);
                    
            //FIN 
            return $re;
        }else{
            return -5;
        }
    }
    public function editarVigenciasDeOfertas($idBotilleria){
        if($this->conect->conectarse()){
            //dejo en 0 la vigencia de las demás ofertas de la boti
            $query = "UPDATE oferta SET vigente = 0 WHERE id_boti='$idBotilleria'";
            $re = mysql_query($query);
            return $re;
        }else{
            return -5;
        }
    }
    public function verVigenciaGratis($idBotilleria){
        if($this->conect->conectarse()){
            $query = "SELECT * FROM vigencia_gratis WHERE id_boti='$idBotilleria'";
            $result = mysql_query($query);
            $vigencia = null;
             while($re = mysql_fetch_array($result)){
                    $vigencia = array("id"=>$re[0],
                                      "id_boti"=>$re[1], 
                                      "fecha_ingreso"=>$re[2],
                                      "fecha_termino"=>$re[3]
                                     );
                }
                return $vigencia;
        }else{
            return -5;
        }
    }
    public function VerVigenciaOfertasGratis($idBotilleria){
        $vigencia = $this->verVigenciaGratis($idBotilleria);
        $dr = $this->dateDiff($this->hoy(), $vigencia['fecha_termino']);//dias restantes
        $drs = 0;//dias restantes semanal
        if($dr <= 56 && $dr >= 50){// +7
            $drs = $dr - 56 + 7;
        }elseif($dr <= 49 && $dr >= 43){//+14
            $drs = $dr - 56 + 14;
        }elseif($dr <= 42 && $dr >= 36){//+21
            $drs = $dr - 56 + 21;
        }elseif($dr <= 35 && $dr >= 29){//+28
            $drs = $dr - 56 + 28;
        }elseif($dr <= 28 && $dr >= 22){//+35
            $drs = $dr - 56 + 35;
        }elseif($dr <= 21 && $dr >= 15){//+42
            $drs = $dr - 56 + 42;
        }elseif($dr <= 14 && $dr >= 8){//+49
            $drs = $dr - 56 + 49;
        }elseif($dr <= 7 && $dr >= 1){//+56
            $drs = $dr - 56 + 56;
        }
        return $drs;
    }
    /*fin ofertas*/
    /*comunas*/
    public function verComunas($idRegion){
        if($this->conect->conectarse()){
            $query = "SELECT * FROM comunas WHERE padre= $idRegion";
                $result = mysql_query($query);
                $comunas = array();
                while($re = mysql_fetch_array($result)){
                    $comunas[] = array("codigoInterno"=>$re[0],
                                          "nombre"=>$re[1], 
                                          "padre"=>$re[2]
                                        );
                }
                return $comunas;
        }
    }
    public function verComunaPorId($id){
        if($this->conect->conectarse()){
            $query = "SELECT * FROM comunas WHERE codigoInterno = $id";
                $result = mysql_query($query);
                $comuna = array();
                while($re = mysql_fetch_array($result)){
                    $comuna = array("codigoInterno"=>$re[0],
                                          "nombre"=>$re[1], 
                                          "padre"=>$re[2]
                                        );
                }
                return $comuna;
        }
    }
/*fin comunas*/
    public function borrarFotoAntiguas($id){
        if($this->conect->conectarse()){
            $query = "SELECT FOTO_PQ, FOTO_GR FROM NOTICIA WHERE ID = $id";
            $result = mysql_query($query);
            $fotoPq = '';
            $fotoGr = '';
            while($re = mysql_fetch_array($result)){
               $fotoPq = $re[0];
               $fotoGr = $re[1];
            }
            $urlPq = '../images/news/'.$fotoPq;
            $urlGr = '../images/news/'.$fotoGr;
            unlink($urlPq);
            unlink($urlGr);
            return true;
        }else{
            return -5;
        }
    }
    
     public function filtrar($texto){
        if($this->conect->conectarse()){
            $query = "SELECT * FROM NOTICIA WHERE TITULO LIKE '%$texto%' ORDER BY ID DESC";
            $result = mysql_query($query);
            $noticias = array();
            while($re = mysql_fetch_array($result)){
                $noticias[] = array( "id"=>$re[0],
                                     "fotoPq"=>$re[2], 
                                     "fotoGr"=>$re[3],
                                     "titulo"=>$re[4],
                                     "contenido"=>$re[5]
                                    );
            }
            return $noticias;
        }else{
            return -5;
        }
    }
    //functions
     public function dateDiff($start, $end) { 

            $start_ts = strtotime($start); 

            $end_ts = strtotime($end); 

            $diff = $end_ts - $start_ts; 

            return round($diff / 86400); 

     } 
     public function verCaducacion($start, $end, $tipo) { 

            $start_ts = strtotime($start); 

            $end_ts = strtotime($end); 

            $diff = $end_ts - $start_ts; 

            $diasRestantes = round($diff / 86400); 
            
            if($tipo == 1){
                if($diasRestantes > 0){//queda más de un dia
                    $html= '<h2 class="tuoferta">Tu oferta activa es:</h2>';
                }elseif($diasRestantes == 0){//caduca hoy
                    $html= '<h2 class="tuoferta">Tu oferta activa es: (caduca HOY)</h2>'; 
                }else{
                    $html= '<h2 class="tuoferta">Tu oferta ha caducado hace '.($diasRestantes * -1).' días, Actívala más abajo!</h2>';        
                }
            }else{
                if($diasRestantes > 0){//queda más de un dia
                    $html= 'Este cupón expira en: <label>'.$diasRestantes.' días</label>';
                }elseif($diasRestantes == 0){//caduca hoy
                    $html= 'Este cupón expira <label>HOY!</label>';
                }else{
                    $html= 'Este cupón ya expiró, ACTÍVALO!';
                }
            }
            return $html;
     } 
     public function hoy(){
        return $hoy = date('Y-m-d H:i:s');//2014-01-22 00:00:00
    }
     public function verFecha($fechaComentario){
//           $datosComentario = explode(' ', $dcto['fechaMuestra']);
//           $fechaComentario = $datosComentario[0];
//           $horaComentario = $datosComentario[1];
        $fechaAc = date('Y-m-d H:i:s');
        
        $fechaAcsinHora = explode(" ",$fechaAc);
        $datosFechaAc = explode("-",$fechaAcsinHora[0]);
        $anioA = $datosFechaAc[0];
        $mesA = $datosFechaAc[1];
        $diaA = $datosFechaAc[2];
        
        
        $fechaComsinHora = explode(" ",$fechaComentario);
        $datosFechaTe = explode("-",$fechaComsinHora[0]);
       // $datosFechaTe = explode("-",$fechaComentarioSin);
        $anioT = $datosFechaTe[0];
        $mesT = $datosFechaTe[1];
        $diaT = $datosFechaTe[2];
        
        if($anioA < $anioT){//si la caducidad es al otro aÃ±o
            $difAnio = $anioT - $anioA;
            $meses = $difAnio * 12;
            if($mesA < $mesT)//si el mes actual es menor al de caducidad
            {  
                $meses+= $mesT - $mesA;    
            }elseif ($mesA > $mesT) {
                $meses-= $mesA - $mesT;
            }
                
        }elseif($anioA == $anioT){//si estoy en el mismo aÃ±o
            if($mesA < $mesT){
                $meses = $mesT - $mesA;
            }elseif ($mesA == $mesT) {
                $meses = 0;
            }else{
                $meses = 0;
            }
            
        }
        
        if($diaA < $diaT){
                    $dias = $diaT - $diaA;
                }elseif($diaA > $diaT){
                    $dias = 30 - ($diaA - $diaT);
                    $meses--;
                }else{//mismo dia
                    $dias = 0;
                }
       $texto = '';
       //SI ES HOY
       if($meses == 0 && $dias == 0){
            $resta = $this->diferenciaEntreFechas($fechaComentario, $fechaAc, "MINUTOS", TRUE);
            if($resta < 60){
                if($resta == 0){
                    $texto = 'Justo ahora';
                }elseif($resta == 1){
                    $texto = 'Hace 1 minuto';
                }else{
                    $texto = 'Hace '.$resta.' minutos';
                }
            }else{
                $resta = $this->diferenciaEntreFechas($fechaComentario, $fechaAc, "HORAS", TRUE);
                if($resta == 1){
                    $texto = 'Hace una hora';
                }else{
                    $texto = 'Hace '.$resta.' horas';
                }     
            }
       }else{
           $resta = $this->diferenciaEntreFechas($fechaComentario, $fechaAc, "DIAS", TRUE);
           if($resta == 1){
               $texto = 'Hace un dia';
           }elseif($resta == 0){
               $texto = 'Hace algunas horas';
           }else{
                $texto = 'Hace '.$resta.' dias';
           }
       }       
       return $texto;   
    }
    
    function diferenciaEntreFechas($fecha_principal, $fecha_secundaria, $obtener = 'SEGUNDOS', $redondear = false){
        $f0 = strtotime($fecha_principal);
        $f1 = strtotime($fecha_secundaria);
        if ($f0 < $f1) 
        {
            $tmp = $f1; 
            $f1 = $f0; 
            $f0 = $tmp; 
         }
        $resultado = ($f0 - $f1);
        switch ($obtener) {
            default: break;
            case "MINUTOS"   :   $resultado = $resultado / 60;   break;
            case "HORAS"     :   $resultado = $resultado / 60 / 60;   break;
            case "DIAS"      :   $resultado = $resultado / 60 / 60 / 24;   break;
            case "SEMANAS"   :   $resultado = $resultado / 60 / 60 / 24 / 7;   break;
        }
        if($redondear) $resultado = round($resultado);
        return $resultado;
}
}

?>
