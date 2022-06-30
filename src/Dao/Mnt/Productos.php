<?php
/**
 * PHP Version 7
 * Modelo de Datos para modelo
 *
 * @category Data_Model
 * @package  Models${1:modelo}
 * @author   Angel David Quintanilla
 * @license  Comercial http://
 *
 * @version 1.0.0
 *
 * @link http://url.com
 */

namespace Dao\Mnt;

use Dao\Table;

/**
 * Modelo de Datos para la tabla de Productos
 *
 * @category Data_Model
 * @package  Dao.Table
 * @author  Angel David Quintanilla
 * @license  Comercial http://
 *
 * @link http://url.com
 */
class Productos extends Table
{
    /*
        `invPrdId` bigint(13) NOT NULL AUTO_INCREMENT,
        `invPrdBrCod` varchar(128) DEFAULT NULL,
        `invPrdCodInt` varchar(128) DEFAULT NULL,
        `invPrdDsc` varchar(128) DEFAULT NULL,
        `invPrdTip` char(3) DEFAULT NULL,
        `invPrdEst` char(3) DEFAULT NULL,
        `invPrdPadre` bigint(13) DEFAULT NULL,
        `invPrdFactor` int(11) DEFAULT NULL,
        `invPrdVnd` char(3) DEFAULT NULL,
    */
    /**
     * Obtiene todos los registros de Productos
     *
     * @return array
     */
    public static function getAll()
    {
        $sqlstr = "Select * from productos;";
        return self::obtenerRegistros($sqlstr, array());
    }
    /**
     * Get Producto By Id
     *
     * @param int $invPrdId Codigo del Producto
     *
     * @return array
     */
    public static function getById(int $invPrdId)
    {
        $sqlstr = "SELECT * from `productos` where invPrdId=:invPrdId;";
        $sqlParams = array("invPrdId" => $invPrdId);
        return self::obtenerUnRegistro($sqlstr, $sqlParams);
    }

    /**
     * Insert into Productos
     *
     * @param [type] $invPrdBrCod  description
     * @param [type] $invPrdCodInt description
     * @param [type] $invPrdDsc    description
     * @param [type] $invPrdTip    description
     * @param [type] $invPrdEst    description
     * @param [type] $invPrdPadre  description
     * @param [type] $invPrdFactor description
     * @param [type] $invPrdVnd    description
     *
     * @return void
     */
    public static function insert(
        $invPrdBrCod,
        $invPrdCodInt,
        $invPrdDsc,
        $invPrdTip,
        $invPrdEst,
        $invPrdPadre,
        $invPrdFactor,
        $invPrdVnd
    ) {
        $sqlstr = "INSERT INTO `productos`
(`invPrdBrCod`, `invPrdCodInt`,
`invPrdDsc`, `invPrdTip`, `invPrdEst`,
`invPrdPadre`, `invPrdFactor`, `invPrdVnd`)
VALUES
(:invPrdBrCod, :invPrdCodInt,
:invPrdDsc, :invPrdTip, :invPrdEst,
:invPrdPadre, :invPrdFactor, :invPrdVnd);
";
        $sqlParams = [
            "invPrdBrCod" => $invPrdBrCod ,
            "invPrdCodInt" => $invPrdCodInt ,
            "invPrdDsc" => $invPrdDsc ,
            "invPrdTip" => $invPrdTip ,
            "invPrdEst" => $invPrdEst ,
            "invPrdPadre" => $invPrdPadre ,
            "invPrdFactor" =>  $invPrdFactor ,
            "invPrdVnd" => $invPrdVnd
        ];
        return self::executeNonQuery($sqlstr, $sqlParams);
    }
    /**
     * Updates productos
     *
     * @param [type] $invPrdBrCod  description
     * @param [type] $invPrdCodInt description
     * @param [type] $invPrdDsc    description
     * @param [type] $invPrdTip    description
     * @param [type] $invPrdEst    description
     * @param [type] $invPrdPadre  description
     * @param [type] $invPrdFactor description
     * @param [type] $invPrdVnd    description
     * @param [type] $invPrdId     description
     *
     * @return void
     */
    public static function update(
        $invPrdBrCod,
        $invPrdCodInt,
        $invPrdDsc,
        $invPrdTip,
        $invPrdEst,
        $invPrdPadre,
        $invPrdFactor,
        $invPrdVnd,
        $invPrdId
    ) {
        $sqlstr = "UPDATE `productos` set
`invPrdBrCod`=:invPrdBrCod, `invPrdCodInt`=:invPrdCodInt,
`invPrdDsc`=:invPrdDsc, `invPrdTip`=:invPrdTip, `invPrdEst`=:invPrdEst,
`invPrdPadre`=:invPrdPadre, `invPrdFactor`=:invPrdFactor, `invPrdVnd`=:invPrdVnd
 where `invPrdId` = :invPrdId;";
        $sqlParams = array(
            "invPrdBrCod" => $invPrdBrCod,
            "invPrdCodInt" => $invPrdCodInt,
            "invPrdDsc" => $invPrdDsc,
            "invPrdTip" => $invPrdTip,
            "invPrdEst" => $invPrdEst,
            "invPrdPadre" => $invPrdPadre,
            "invPrdFactor" => $invPrdFactor,
            "invPrdVnd" => $invPrdVnd,
            "invPrdId" => $invPrdId
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    /**
     * Undocumented function
     *
     * @param [type] $invPrdId description
     *
     * @return void
     */
    public static function delete($invPrdId)
    {
        $sqlstr = "DELETE from `productos` where invPrdId = :invPrdId;";
        $sqlParams = array(
            "invPrdId" => $invPrdId
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    /*
    public static function getProductosRecientes()
    {
        return self::obtenerRegistros("SELECT * FROM productos p INNER JOIN media m on p.ProdId = m.ProdId WHERE ProdStock > 0 AND ProdEst = 'ACT' GROUP BY p.ProdId ORDER BY p.ProdId DESC LIMIT 8;", array());
    }
*/

    /**
     * Contar cantidad de productos que tenemos en el inventario y que estan activos
     */
    public static function getProductCount()
    {
        $sqlstr = "SELECT COUNT(invPrdId) as 'Total' FROM productos WHERE invPrdStock > 0 AND invPrdEst = 'ACT' ;";
        return self::obtenerUnRegistro($sqlstr, array());
    }

    /**
     * Obtiene la lista de productos por pagina, (Mostrar)
     *  @param $Inicio
     * @param $Limite
     */
    public static function getProductosforPage($Inicio, $Limite)
    {
        $sqlstr = "SELECT * FROM productos p WHERE p.invPrdStock > 0 AND p.invPrdEst = 'ACT'  LIMIT :Inicio, :Limite;"; 
        return self::obtenerRegistrosIntParams($sqlstr, array("Inicio"=>$Inicio, "Limite"=>$Limite));
    }

    /**
     * Selecciona un producto en especifico por el id y estado activo
     * @param $ProdId
     */
    public static function getOne($ProdId)
    {
        $sqlstr = "SELECT * FROM productos p  WHERE p.invPrdId = :ProdId AND p.invPrdEst = 'ACT';";
        return self::obtenerUnRegistro($sqlstr, array("ProdId"=>$ProdId));
    }

   /**
    * Buscar el producto por la descripcion
    * @param $UsuarioBusqueda lo que escribe el usario para buscar.
    * @param $Inicio
    * @param $Limite
    */
    static public function searchProductosCliente($UsuarioBusqueda, $Inicio, $Limite)
    {
        $sqlstr = "SELECT * FROM productos p WHERE p.invPrdEst = 'ACT' AND p.invPrdStock > 0 AND (p.invPrdDsc LIKE :UsuarioBusqueda) or (p.invPrdPrecioVenta like :UsuarioBusqueda) LIMIT :Inicio, :Limite;";
        return self::obtenerRegistros($sqlstr, array("UsuarioBusqueda"=>"%".$UsuarioBusqueda."%", "Inicio"=>intval($Inicio), "Limite"=>intval($Limite)));
    }
    /**
     * Encontramos los productos por un rango de precio especifico
     * @param $rangoInicial
     * @param $rangoFinal
     * @param $Inicio
     * @param $Limite
     * 
     */
    static public function searchProductosByPrice($rangoInicial,$rangoFinal,$Inicio,$Limite)
    {
        $sqlstr = "SELECT * FROM productos p WHERE p.invPrdEst = 'ACT' AND p.invPrdStock > 0 AND p.invPrdPrecioVenta between :rangoInicial and :rangoFinal LIMIT :inicio, :limite;";
        return self::obtenerRegistros($sqlstr, array("rangoInicial" => $rangoInicial, "rangoFinal"=>$rangoFinal,"inicio"=>$Inicio,"limite"=>$Limite));
    }

    /**
     * Cuenta el total de productos que se encuentrarn en un rango especifico 
     * @param $rangoInicial
     * @param $rangoFinal
     */
    static public function searchProductosByPriceCount($rangoInicial,$rangoFinal){
        $sqlstr = "SELECT count(*) as 'Total' FROM productos p WHERE p.invPrdEst = 'ACT' AND p.invPrdStock > 0 AND p.invPrdPrecioVenta between :rangoInicial and :rangoFinal;";
        return self::obtenerRegistros($sqlstr, array("rangoInicial" => $rangoInicial, "rangoFinal"=>$rangoFinal));
    }

     /**
     * Cuenta el total de productos que se encuentran por la descripcicon
     * @param $UsuarioBusqueda
     */
    static public function searchProductosClienteCount($UsuarioBusqueda)
    {
        $sqlstr = "SELECT COUNT(invPrdId) as 'Total' FROM productos WHERE invPrdStock > 0 AND invPrdEst = 'ACT' AND (invPrdDsc LIKE :UsuarioBusqueda);";
        return self::obtenerUnRegistro($sqlstr, array("UsuarioBusqueda"=>"%".$UsuarioBusqueda."%"));
    }

}