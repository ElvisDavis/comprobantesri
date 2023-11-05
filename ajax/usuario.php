<?php
session_start();
require_once("../modelos/Usuario.php");
$usuario = new Usuario();
$idusuario = isset($_POST["idusuario"]) ? limpiarCadena($_POST["idusuario"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$telefono = isset($_POST["telefono"]) ? limpiarCadena($_POST["telefono"]) : "";
$direccion = isset($_POST["direccion"]) ? limpiarCadena($_POST["direccion"]) : "";
$email = isset($_POST["email"]) ? limpiarCadena($_POST["email"]) : "";
$clave = isset($_POST["clave"]) ? limpiarCadena($_POST["clave"]) : "";
$imagen = isset($_POST["imagen"]) ? limpiarCadena($_POST["imagen"]) : "";

switch ($_GET["accion"]) {
    case 'guardaryeditar':
        if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
            # code...
            $imagen = $_POST["imagenactual"];
        } else {
            # code...
            $ext = explode(".", $_FILES["imagen"]["name"]);
            if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['image']['type'] == "image/jpeg" || $FILES['image']['type'] == "image/png") {
                # code...
                $imagen = round(microtime(true)) . '.' . end($ext);
                move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios" . $imagen);
            }
        }
        //Hash sha256 en la contraseña
        $clavehash = hash("SHA256", $clave);
        if (empty($idusuario)) {
            # code...
            $rspta = $usuario->insertar($nombre, $telefono, $direccion, $email, $clavehash, $imagen, $_POST['permisos']);
            echo $rspta ? "Usuario registrado con exito" : "El usuario no puedo ser registrado";

        } else {
            # code...
            $rspta = $usuario->editar($idusuario, $nombre, $telefono, $direccion, $email, $clavehash, $imagen, $_POST['permisos']);
            echo $rspta ? "Usuario editado correctamente" : "El usuario no se pudo editar";
        }
        break;
    case 'desactivar':
        $rspta = $usuario->desactivar($idusuario);
        echo $rspta ? "Usuario Desactivado" : "Usuario no se pudo desactivar ";
        break;
    case 'activar':
        $rspta = $usuario->activar($idusuario);
        echo $rspta ? "Usuario activado" : "El usuario no se puede activar";
        break;
    case 'mostrar':
        $rspta = $usuario->mostrar($idusuario);
        //codificamos el resultado utilizando json 
        echo json_encode($rspta);
        break;
    case 'listar':
        $rspta = $usuario->listar();
        //vamos a declarar un array
        $data = array();
        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => ($reg->condicion) ? '<button class="btn btn-warning" onclick="mostrar(' . $reg->idusuario . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btn btn-danger" onclick="desactivar(' . $reg->idusuario . ')"><i class="fa fa-close"></i></button>' :
                    '<button class="btn btn-warning" onclick="mostrar(' . $reg->idusuario . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btn btn-primary" onclick="activar(' . $reg->idusuario . ')"><i class="fa fa-check"></i></button>',
                "1" => $reg->nombre,
                "2" => $reg->$telefono,
                "3" => $reg->direccion,
                "4" => $reg->email,
                "5" => "<img src='../files/usuarios/" . $reg->imagen . "' height='50px' width='50px' >",
                "6" => ($reg->condicion) ? '<span class="label bg-green">Activado</span>' :
                    '<span class="label bg-red">Desactivado</span>'

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
    case 'permisos':
        //Obtenemos todos los permisos de la tabla permisos
        require_once "../modelos/Permisos.php";
        $permiso = new Permiso();
        $rspta = $permiso->listar();

        //Obtener los permisos asignados al usuario
        $id = $_GET['id'];
        $marcados = $usuario->listarmarcados($id);
        //Declaramos el array para almacenar todos los permisos marcados
        $valores = array();

        //Almacenar los permisos asignados al usuario en el array
        while ($per = $marcados->fetch_object()) {
            array_push($valores, $per->idpermisos);
        }

        //Mostramos la lista de permisos en la vista y si están o no marcados
        while ($reg = $rspta->fetch_object()) {
            $sw = in_array($reg->idpermisos, $valores) ? 'checked' : '';
            echo '<li> <input type="checkbox" checked="checked" ' . $sw . '  name="permiso[]" value="' . $reg->idpermisos . '">' . $reg->nombre . '</li>';
        }
        break;
    case 'verificar':
        $logina = $_POST['logina'];
        $clavea = $_POST['clavea'];

        //Hash SHA256 en la contraseña
        $clavehash = hash("SHA256", $clavea);

        $rspta = $usuario->verificar($logina, $clavehash);

        $fetch = $rspta->fetch_object();

        if (isset($fetch)) {
            //Declaramos las variables de sesión
            $_SESSION['idusuario'] = $fetch->idusuario;
            $_SESSION['nombre'] = $fetch->nombre;
            $_SESSION['imagen'] = $fetch->imagen;
            $_SESSION['email'] = $fetch->email;

            //Obtenemos los permisos del usuario
            $marcados = $usuario->listarmarcados($fetch->idusuario);

            //Declaramos el array para almacenar todos los permisos marcados
            $valores = array();

            //Almacenamos los permisos marcados en el array
            while ($per = $marcados->fetch_object()) {
                array_push($valores, $per->idpermiso);
            }

            //Determinamos los accesos del usuario
            in_array(1, $valores) ? $_SESSION['Administrador'] = 1 : $_SESSION['Administrador'] = 0;
            in_array(2, $valores) ? $_SESSION['Usuario'] = 1 : $_SESSION['Usuario'] = 0;
           
        }
        echo json_encode($fetch);
        break;

    case 'salir':
        //Limpiamos las variables de sesión
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../index.php");

        break;






}

?>