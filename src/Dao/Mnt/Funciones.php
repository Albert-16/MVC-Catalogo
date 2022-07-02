<?php

/**
 * PHP Version 7
 * Modelo de Datos para modelo
 * 
 * @category Data_Model
 * @package Models${1:modelo}
 * @author Grupo #1
 * @license Comercial http://
 * 
 * @version 1.0.0
 * 
 * @link http://url.com  
 */

namespace Dao\Mnt;

use Dao\Table;

use function Symfony\Component\DependencyInjection\Loader\Configurator\ref;

/**
 * Modelo de Datos para la tabla de Funciones
 *
 * @category Data_Model
 * @package  Dao.Table
 * @author  Grupo #1
 * @license  Comercial http://
 *
 * @link http://url.com
 */
class Funciones extends Table
{
    /*
     `fncod` varchar(255) NOT NULL,
     `fndsc` varchar(45) DEFAULT NULL,
     `fnest` char(3) DEFAULT NULL,
     `fntyp` char(3) DEFAULT NULL,
      PRIMARY KEY (`fncod`)
    */
    /** Obtiene todos los registros de la tabla de Funciones
     *
     * @return array
     */
    public static function getAll()
    {
        $sqlstr = "SELECT * FROM funciones;";
        return self::obtenerRegistros($sqlstr, array());
    }
    /**
     * Get Funcion By Id
     *
     * @param int $fncod Codigo de la funcion
     *
     * @return array
     */
    public static function getById($fncod)
    {
        $sqlstr = "SELECT * FROM `funciones` where `fncod` =:fncod;";
        $sqlParams = array("fncod" => $fncod);
        return self::obtenerUnRegistro($sqlstr, $sqlParams);
    }
    /**
     * Insert into funciones
     * 
     * @param [type] $fncod  description
     * @param [type] $fndsc  description
     * @param [type] $fnest  description
     * @param [type] $fntyp  description
     * 
     * @return void
     */
    public static function insert($fncod, $fndsc, $fnest, $fntyp)
    {
        $sqlstr = "INSERT INTO `nw202202`.`funciones`
        (`fncod`, `fndsc`, `fnest`, `fntyp`)
        VALUES
        (:fncod, :fndsc, :fnest, :fntyp);";
        $sqlParams = [
            "fncod" => $fncod,
            "fndsc" => $fndsc,
            "fnest" => $fnest,
            "fntyp" => $fntyp
        ];
        return self::executeNonQuery($sqlstr, $sqlParams);
    }
    /**
     * Updates funciones
     * 
     * @param [type] $fncod  description
     * @param [type] $fndsc  description
     * @param [type] $fnest  description
     * @param [type] $fntyp  description
     * 
     * @return void
     */
    public static function update($fncod, $fndsc, $fnest, $fntyp){
        $sqlstr = "UPDATE `nw202202`.`funciones` SET
        `fncod` = :fncod,
        `fndsc` = :fndsc,
        `fnest` = :fnest,
        `fntyp` = :fntyp
        WHERE `fncod` = :fncod";
        $sqlParams = array(
            "fncod" => $fncod,
            "fndsc" => $fndsc,
            "fnest" => $fnest,
            "fntyp" => $fntyp
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }
    /**
     * Undocumented function
     * 
     * @param [type] $fncod  description
     *
     * @return void
     */
    public static function delete($fncod){
        $sqlstr = "DELETE FROM `functions` WHERE `fncod` = :fncod;";
        $sqlParams = array(
            "fncod" => $fncod
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }


}
