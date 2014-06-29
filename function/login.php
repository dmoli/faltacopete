<?php
session_start();
$_SESSION['id_boti'] = 3;
$_SESSION['nombre_boti'] = 'Holaaaaaa';
header("location:http://www.faltacopete.cl/home-adminasd");
//require_once '../DAL/connect_relacional.php';
//require_once '../DAL/botilleria.php';
//require_once '../function/allfunction.php';
//if(isset($_REQUEST['login']))
//{
//        $usuario = safeForDB($_REQUEST['usuario']);
//        $clave = safeForDB($_REQUEST['clave']);   
//        $botilleria = new botilleria();
//        $encontrado = $botilleria->login($usuario, $clave);
//        if($encontrado != null){
//                    $_SESSION['id_boti'] = $encontrado['id'];
//                    $_SESSION['nombre_boti'] = $encontrado['nombre'];
////                    $_SESSION["ultimoAcceso"] = time(); 
//                        
////                        $_SESSION["ultimoAcceso"] = time();
////                        echo $_SESSION['id_boti'];
//                    header("location:http://www.faltacopete.cl/home-admin");
//        }else{
//            $encontrado = $botilleria->loginAdmin($usuario, $clave);
//            if($encontrado != null){
//                header("location:http://www.faltacopete.cl/agregar-botilleria");
//            }else{
//                header("location:http://www.faltacopete.cl/login");
//            }
//        }
//       
//}
?>