<?php
//incluiremois inicialmente la conexion ala base de datos
require "../config/Conexion.php";
Class Usuario
{
    //implementamos nuestro constructor
    public function __construct()
    {

    }  

    //implementamos un método para insertar registros
    public function insertar($nombre,$telefono,$email,$clave,$imagen,$permisos)
    {
        $sql="INSERT INTO usuario(nombre,telefono,email,clave,imagen,condicion)
        VALUES('$nombre','$telefono','$email','$clave','$imagen','1')";
        //return ejecutarConsulta($sql);
        $idusuarionew=ejecutarConsulta_retornarID($sql);
        $num_elementos=0;
        $sw=true;
        while ($num_elementos < count ($permisos)) {
            # code...
            $sql_detalle="INSERT INTO permisousuario(idusuario,idpermisos) VALUES('$idusuarionew','$permisos[$num_elementos]')";
            ejecutarConsulta($sql_detalle) or $sw = false;
            $num_elementos=$num_elementos +1;
        }
        return $sw;
    }

    //implementamos un método par editar registros
    public function editar ($idusuario,$nombre,$telefono,$email,$clave,$imagen,$permisos)
    {
        $sql= "UPDATE usuario SET nombre='$nombre', telefono='$telefono',email='$email',clave='$clave',imagen='$imagen' WHERE idusuario='$idusuario'";
        ejecutarConsulta($sql);
        //Eliminmos todos los permisos asignados para volverlos a registrar
        $sqldel="DELETE FROM permisousuario WHERE idusuario='$idusuario'";
        ejecutarConsulta($sqldel);
        $num_elementos=0;
        $sw=true;
        while($num_elementos < count($permisos))
        {
            $sql_detalle= "INSERT INTO permisousuari(idusuario,idpermisos)VALUES('$idusuario','$permisos[$num_elementos]')";
            ejecutarConsulta($sql_detalle) or $sw = false;  
            $num_elementos=$num_elementos + 1;
        }
        return $sw;

    }
    //IMplementamos un método para desactivar un usuario
    public function desactivar ($idusuario)
    {
        $sql="UPDATE usuario SET condicion='0' WHERE idusuario = '$idusuario'";
        return ejecutarConsulta($sql);
    }
    //Implementamos una función para activar el usuario
    public function activar($idusuario)
    {
        $sql="UPDATE usuario SET condicion='1' WHERE idsuario='$idusuario'";
        return ejecutarConsulta($sql);
    }
    //implementamos n método para mostrar el registro a modificar
    public function mostrar($idusuario)
    {
        $sql="SELECT * FROM usuario WHERE idusuario='$idusuario'";
        return ejecutarConsulta($sql);
    }
    //implementamos un método para listar los registros
    public function listar()
    {
        $sql="SELECT *FROM usuario";
        return ejecutarConsulta($sql);

    }

    //implementamos una función para listar os permisos marcados 
    public function listarmarcados($idusuario)
    {
        $sql="SELECT *FROM permisousuario WHERE idusuario='$idusuario'";
        return ejecutarConsulta($sql);
    }

    //Funcion para verificar aaceso al sistema
    public function verificar($email, $clave)
    {
        $sql="SELECT idusurio, nombre, email FROM usuario WHERE email='$email' AND clave='$clave'AND condicion='1'";
        return ejecutarConsulta($sql);
    }
}
?>