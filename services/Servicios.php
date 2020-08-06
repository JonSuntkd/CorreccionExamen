<?php

include 'MainService.php';

class Servicios extends MainService
{
    //MODULOS
    function mostrarModulos()
    {
        return $this->conexion->query("SELECT * FROM SEG_MODULO WHERE ESTADO='ACT'");
    }
    function insertarModulo($cod_modulo,$nombre,$estado)
    {
        $stmt = $this->conexion->prepare("INSERT INTO SEG_MODULO(COD_MODULO,NOMBRE,ESTADO) 
                                          VALUES (?,?,?)");
        $stmt->bind_param('sss',$cod_modulo,$nombre,$estado);
        $stmt->execute();
        $stmt->close();
    }
    function encontrarModulo($cod_modulo)
    {
        $result = $this->conexion->query("SELECT * FROM SEG_MODULO WHERE COD_MODULO='".$cod_modulo."'");
        if($result->num_rows>0)
        {
            return $result->fetch_assoc();
        }
        else
        {
            return null;
        }
    }
    function modificarModulo($cod_modulo, $nombre, $estado, $cod_modulo_comparar)
    {
        $stmt = $this->conexion->prepare("UPDATE SEG_MODULO SET COD_MODULO=?,NOMBRE=?,ESTADO=?
                                          WHERE COD_MODULO=?");
        $stmt->bind_param('ssss' ,$cod_modulo, $nombre, $estado, $cod_modulo_comparar);
        $stmt->execute();
        $stmt->close();
    }
    function eliminarLogicoModulo($cod_modulo)
    {
        $stmt = $this->conexion->prepare("UPDATE SEG_MODULO SET ESTADO='INA' WHERE COD_MODULO=?");
        $stmt->bind_param('s',$cod_modulo);
        $stmt->execute();
        $stmt->close();
    }

    //FUNCIONALIDADES
    function mostrarFuncionalidades($cod_modulo)
    {
        return $this->conexion->query("SELECT * FROM SEG_FUNCIONALIDAD WHERE COD_MODULO='".$cod_modulo."'");
    }
    function insertarFuncionalidad ($url_principal,$nombre,$descripcion,$cod_modulo)
    {
        $stmt = $this->conexion->prepare("INSERT INTO SEG_FUNCIONALIDAD(COD_MODULO,URL_PRINCIPAL,NOMBRE,DESCRIPCION) 
                                          VALUES (?,?,?,?)");
        $stmt->bind_param('ssss',$cod_modulo,$url_principal,$nombre,$descripcion);
        $stmt->execute();
        $stmt->close();
    }
    function encontrarFuncionalidad($cod_funcionalidad,$cod_modulo)
    {
        $result = $this->conexion->query("SELECT * FROM SEG_FUNCIONALIDAD WHERE COD_FUNCIONALIDAD='".$cod_funcionalidad."' AND COD_MODULO='".$cod_modulo."'");
        if($result->num_rows>0)
        {
            return $result->fetch_assoc();
        }
        else
        {
            return null;
        }
    }
    function modificarFuncionalidad($cod_funcionalidad,$url,$nombre,$descripcion)
    {
        $stmt = $this->conexion->prepare("UPDATE SEG_FUNCIONALIDAD SET URL_PRINCIPAL=?,NOMBRE=?,DESCRIPCION=?
                                          WHERE COD_FUNCIONALIDAD=?");
        $stmt->bind_param('ssss' ,$url, $nombre, $descripcion, $cod_funcionalidad);
        $stmt->execute();
        $stmt->close();
    }
    function eliminarFuncionalidad($cod_funcionalidad)
    {
        $stmt = $this->conexion->prepare("DELETE FROM SEG_FUNCIONALIDAD WHERE COD_FUNCIONALIDAD=?");
        $stmt->bind_param('s',$cod_funcionalidad);
        $stmt->execute();
        $stmt->close();
    }

    //ROLES
    function mostrarRoles()
    {
        return $this->conexion->query("SELECT * FROM SEG_ROL ");
    }
    function mostrarModulosPorRol($cod_rol)
    {
        return $this->conexion->query("SELECT ROL_MODULO.COD_ROL,SEG_MODULO.NOMBRE, SEG_MODULO.COD_MODULO
        FROM SEG_MODULO 
        INNER JOIN ROL_MODULO 
        ON SEG_MODULO.COD_MODULO = ROL_MODULO.COD_MODULO
        WHERE ROL_MODULO.COD_ROL = '".$cod_rol."'");
    }
    function insertarModuloPorRol($cod_rol,$cod_modulo)
    {
        $stmt = $this->conexion->prepare("INSERT INTO ROL_MODULO(COD_ROL,COD_MODULO) 
                                          VALUES (?,?)");
        $stmt->bind_param('ss',$cod_rol,$cod_modulo);
        $stmt->execute();
        $stmt->close();
    }

    function eliminarrol($cod_rol,$cod_modulo)
    {
        $stmt = $this->conexion->prepare("DELETE FROM ROL_MODULO WHERE COD_ROL=? AND COD_MODULO=?");
        $stmt->bind_param('ss',$cod_rol,$cod_modulo);
        $stmt->execute();
        $stmt->close();
    }

     function elrol($cod_modulo)
    {
        $stmt = $this->conexion->prepare("DELETE FROM ROL_MODULO WHERE COD_ROL=?");
        $stmt->bind_param('s',$cod_modulo);
        $stmt->execute();
        $stmt->close();
    }

}

?>