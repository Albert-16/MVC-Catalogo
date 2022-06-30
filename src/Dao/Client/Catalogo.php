<?php

namespace Dao\Client;

class Productos extends \Dao\Table
{
    public static function getProductosRecientes()
    {
        return self::obtenerRegistros("SELECT * FROM productos p INNER JOIN media m on p.ProdId = m.ProdId WHERE ProdStock > 0 AND ProdEst = 'ACT' GROUP BY p.ProdId ORDER BY p.ProdId DESC LIMIT 8;", array());
    }

    public static function getProductCount()
    {
        $sqlstr = "SELECT COUNT(invPrdId) as 'Total' FROM productos WHERE invPrdStock > 0 AND invPrdEst = 'ACT' ;";
        return self::obtenerUnRegistro($sqlstr, array());
    }

    public static function getProductosforPage($Inicio, $Limite)
    {
        $sqlstr = "SELECT * FROM productos p WHERE p.invPrdStock > 0 AND p.invPrdEst = 'ACT'  LIMIT :Inicio, :Limite;"; 
        return self::obtenerRegistrosIntParams($sqlstr, array("Inicio"=>$Inicio, "Limite"=>$Limite));
    }

    public static function getOne($ProdId)
    {
        $sqlstr = "SELECT * FROM productos p  WHERE p.invPrdId = :ProdId AND p.invPrdEst = 'ACT';";
        return self::obtenerUnRegistro($sqlstr, array("ProdId"=>$ProdId));
    }

   

    static public function searchProductosCliente($UsuarioBusqueda, $Inicio, $Limite)
    {
        $sqlstr = "SELECT * FROM productos p WHERE p.invPrdEst = 'ACT' AND p.invPrddStock > 0 AND (p.invPrdDsc LIKE :UsuarioBusqueda) LIMIT :Inicio, :Limite;";
        return self::obtenerRegistros($sqlstr, array("UsuarioBusqueda"=>"%".$UsuarioBusqueda."%", "Inicio"=>intval($Inicio), "Limite"=>intval($Limite)));
    }

    static public function searchProductosClienteCount($UsuarioBusqueda)
    {
        $sqlstr = "SELECT COUNT(invPrdId) as 'Total' FROM productos WHERE invPrdStock > 0 AND invPrdEst = 'ACT' AND (invPrdDsc LIKE :UsuarioBusqueda);";
        
        return self::obtenerUnRegistro($sqlstr, array("UsuarioBusqueda"=>"%".$UsuarioBusqueda."%"));
    }
}

?>