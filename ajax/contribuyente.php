<?php
require_once ("../modelos/Contribuyente.php");
$contribuyente= new COntribuyente();
$idcontribuyente= isset($_POST["idcontribuyente"]) ? $_POST["idcontribuyente"] :"";
$idusuario=isset($_POST["idusuario"]) ? $_POST["idusuario"] :"";
$razonsocial=isset($_POST["razonsocial"]) ? $_POST["razonsocial"] :"";
$direccion=isset($_POST["direccion"]) ? $_POST["direccion"] :"";
$telefono=isset($_POST["telefono"]) ? $_POST["telefono"] :"";
$email=isset($_POST["email"]) ? $_POST["email"] :"";
$ruc=isset($_POST["ruc"]) ? $_POST["ruc"] :"";
$clave=isset($_POST["clave"]) ? $_POST["clave"] :"";
switch($_GET["accion"]){
    case "guardaryeditar":
        //Encriptamos la clave del sri
        $clavemd=md5($clave);
        if (empty($iduaurio)) {
            # code...
            $rspta=$contribuyente->insertar($idusuario, $razonsocial,$direccion,$telefono,$email,$ruc,$clavemd);
            echo $rspta ? "Contibuyente ingresado con exito" : "El contribuyente no se pudo ingresar";

        } else {
            $rspta=$contribuyente->editar($idcontribuyente,$idusuario,$razonsocial,$direccion,$telefono,$email,$ruc,$clavemd);
            
        }
        
}



?>