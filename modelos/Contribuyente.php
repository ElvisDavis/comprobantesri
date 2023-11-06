<?php
//incluimos inicialmente la conexion a la base de datos 
require "../config/Conexion.php";
Class Contribuyente
{
    public function __construct()
    {

    }

    //implementamos un método para insertar registros
    public function insertar($idusuario, $razonsocial, $direccion, $telefono,$email,$ruc,$clave)
    {
        $sql="INSERT INTO contribuyente(idusuario,razonsocial,direccion,telefono,email,ruc,clave,estado)
        VALUES('$idusuario','$razonsocial','$direccion','$telefono','$email','$ruc','$clave','1')";
        return ejecutarConsulta($sql);
    }
    //implementamos un método para editar el contribuyente
    public function editar($idcontribuyente,$idusuario,$razonsocial,$direccion,$telefono,$email,$ruc)
    {
        $sql= "UPDATE contribuyente SET idusuario='$idusuario', razonsocial='$razonsocial', direccion='$direccion',telefono='$telefono', email='$email',ruc='$ruc'
        WHERRE idcontribuyente='$idcontribuyente'";
        return ejecutarConsulta($sql);
    }

    //implementamos un método para adesactivar el asociado
    public function desactivar($idcontribuyente)
    {
        $sql="UPDATE contribuyente SET estado = '0' WHERE idcontribuyente='$idcontribuyente'";
        return ejecutarConsulta($sql);  
    }

    //implementamos un método para activar la cuanta asociada
    public function activar ($idcontribuyente)
    {
        $sql="UPDATE contribuyente SET estado = '1' WHERE idcontribuyente='$idcontribuyente'";
        return ejecutarConsulta($sql);

    }

    //implementamos un mpetodo para mstra l registro que se va a editar
    public function mostrar($idcontribuyente)
    {
        $sql= "SELECT * FROM contribuyente WHERE idcontribuyente='$idcontribuyente' ";
        return ejecutarConsultaSimpleFila($sql);

    }

    //implementamos un mpetodo para listar las cuentas asociadas al usuario
    public function listar()
    {
        $sql="SELECT * FROM contribuyente";
        return ejecutarConsulta($sql);
    }
}
?>