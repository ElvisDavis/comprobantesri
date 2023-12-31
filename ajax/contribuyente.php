<?php
if (strlen(session_id()) < 1)
    session_start();
require_once("../modelos/Contribuyente.php");
$contribuyente = new COntribuyente();
$idcontribuyente = isset($_POST["idcontribuyente"]) ? $_POST["idcontribuyente"] : "";
$idusuario = $_SESSION["idusuario"];
$razonsocial = isset($_POST["razonsocial"]) ? $_POST["razonsocial"] : "";
$direccion = isset($_POST["direccion"]) ? $_POST["direccion"] : "";
$telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$ruc = isset($_POST["ruc"]) ? $_POST["ruc"] : "";
$clave = isset($_POST["clave"]) ? $_POST["clave"] : "";
switch ($_GET["accion"]) {
    case "guardaryeditar":
        //Encriptamos la clave del sri
        $clavemd = md5($clave);
        if (empty($idcontribuyente)) {
            # code...
            $rspta = $contribuyente->insertar($idusuario, $razonsocial, $direccion, $telefono, $email, $ruc, $clavemd);
            echo $rspta ? "Contibuyente ingresado con exito" : "El contribuyente no se pudo ingresar";

        } else {
            $rspta = $contribuyente->editar($idcontribuyente, $idusuario, $razonsocial, $direccion, $telefono, $email, $ruc, $clavemd);
            echo $rspta ? "El contribuyente se edito con exito" : "No se pudo editar los datos del contribuyente";

        }
        break;
    case 'desactivar':
        $rspta = $contribuyente->desactivar($idcontribuyente);
        echo $rspta ? "Cuenta desabilitada" : "Cuenta no se pudo desahabilitar";
        break;
    case 'activar':
        $rspta = $contribuyente->activar($idcontribuyente);
        echo $rspta ? "Cuenta habilitada" : "La cuenta no se pudo desahabilitar";
        break;
    case 'mostrar':
        $rspta = $contribuyente->mostrar($idcontribuyente);
        //codificamos el resultado utilizando json 
        echo json_encode($rspta);
        break;
    case 'listar':
        $rspta = $contribuyente->listar();
        //declaramos un array
        $data = array();
        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => $reg->idcontribuyente,

                "1" => $reg->razonsocial,
                "2" => $reg->direccion,
                "3" => $reg->telefono,
                "4" => $reg->email,
                "5" => $reg->ruc,
              
                "6" => ($reg->estado) ? '<span class="label bg-green">Activado</span>' :
                    '<span class="label bg-red">Desactivado</span>',
                "7" => ($reg->estado) ? '<button class="btn btn-warning" onclick="mostrar(' . $reg->idcontribuyente . ')"><i class="fa fa-pencil"></i></button>' :

                    '<button class="btn btn-warning" onclick="mostrar(' . $reg->idcontribuyente . ')"><i class="fa fa-pencil"></i></button>'
            );
        }
        $results = array(
            "sEcho" => 1,
            //Información para el datatables
            "iTotalRecords" => count($data),
            //enviamos el total registros al datatable
            "iTotalDisplayRecords" => count($data),
            //enviamos el total registros a visualizar
            "aaData" => $data
        );
        echo json_encode($results);

        break;
}



?>