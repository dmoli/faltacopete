<?php
//    require_once 'relacional/connect_relacional.php';
class usuario {
    private $conect;
    function __construct() {
        $this->conect = new connect_relacional();
    }
    function __destruct() {
        $this->conect->desconectarse();
    }
     public function buscarPorId($id)
    {
         if($this->conect->conectarse()){
            $query = "SELECT * FROM usuario WHERE id = '$id'";
            $result = mysql_query($query);
            $usuario = array();
            while($re = mysql_fetch_array($result)){
                $usuario = array("id"=>$re[0],
                                  "nombre"=>$re[1], 
                                  "email"=>$re[2],
                                  "id_comuna"=>$re[3]
                                 );
            }
            return $usuario;
         }
    }
    public function buscarPorMail($email)
    {
         if($this->conect->conectarse()){
            $query = "SELECT * FROM usuario WHERE email = '$email'";
            $result = mysql_query($query);
            $usuario = array();
            while($re = mysql_fetch_array($result)){
                $usuario = array("id"=>$re[0],
                                  "nombre"=>$re[1], 
                                  "email"=>$re[2],
                                  "id_comuna"=>$re[3]
                                 );
            }
            return $usuario;
         }
    }
    public function insertar($nombre, $email, $idComuna){
        $conn = $this->conect->conectarse();
        if($conn){
            $query = "INSERT INTO usuario VALUES('', '$nombre', '$email', '$idComuna') ";
            $re = mysql_query($query);
            $ultimoId = mysql_insert_id($conn);
            return $ultimoId;
        }else{
            return -5;
        }
    }
     public function generarCupon($idOferta, $idUsuario){
        $conn = $this->conect->conectarse();
        if($conn){
            $fecha = $this->hoy();
            $query = "INSERT INTO cupon VALUES('', '$idOferta', '$idUsuario', 'x', '$fecha', 1) ";
            $re = mysql_query($query);
            $ultimoId = mysql_insert_id($conn);
            return $ultimoId;
        }else{
            return -5;
        }
    }
     public function verCuponGenerado($id)
    {
         if($this->conect->conectarse()){
            $query = "SELECT * FROM cupon WHERE id = $id";
            $result = mysql_query($query);
            $cupon = array();
            while($re = mysql_fetch_array($result)){
                $cupon = array("id"=>$re[0],
                                  "id_oferta"=>$re[1], 
                                  "id_usuario"=>$re[2],
                                  "codigo"=>$re[3],
                                  "fecha"=>$re[4],
                                  "autorizado"=>$re[5]
                                 );
            }
            return $cupon;
         }
    }
     public function generarCodigo($idCupon, $idUsuario){
            if(strlen((string)$idUsuario) == 1){//si tiene sólo un dígito se le agrega el "0"
                $part1 = $idUsuario.'0';
            }elseif(strlen((string)$idUsuario) == 2){
                $part1 = (string)$idUsuario[1].(string)$idUsuario[0];
            }elseif(strlen((string)$idUsuario) == 3) {
                $part1 = (string)$idUsuario[1].(string)$idUsuario[0].(string)$idUsuario[2];
            }elseif(strlen((string)$idUsuario) == 4){
                $part1 = (string)$idUsuario[1].(string)$idUsuario[0].(string)$idUsuario[2].(string)$idUsuario[3];
            }
            $idCupon = (string)$idCupon;
            if(strlen($idCupon) == 1){//si tiene sólo un dígito se le agrega el "0"
                $part2 = $idCupon.'0';
            }elseif(strlen($idCupon) == 2){
                $part2 = $idCupon[1].$idCupon[0];
            }elseif(strlen($idCupon) == 3) {
                $part2 = $idCupon[1].$idCupon[0].$idCupon[2];
            }elseif(strlen($idCupon) == 4){
                $part2 = $idCupon[1].$idCupon[0].$idCupon[2].$idCupon[3];
            }
            
            return $part1.$part2;
    }
    
    public function editarCodigoCupon($id, $codigo){
        if($this->conect->conectarse()){
            $query = "UPDATE cupon SET codigo = '$codigo'
                      WHERE id = $id";
            $re = mysql_query($query);
            return $re;
        }else{
            return -5;
        }
    }
    public function aumentarGenerado($id){
        if($this->conect->conectarse()){
            $query = "UPDATE oferta SET cant_generado = cant_generado + 1
                      WHERE id = '$id'";
            $re = mysql_query($query);       
            return $re;
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
     public function hoy(){
        return $hoy = date('Y-m-d H:i:s');//2014-01-22 00:00:00
    }
}

?>
