<?php
/**
 * PHP Version 7
 * Modelo de Datos para Roles
 * @category Data_Model
 * @package  Models${1:modelo}
 * @author   Equipo de trabajo Sala #1
 * @license  Comercial http://
 *
 * @version 1.0.0
 *
 * @link http://url.com
 */

namespace Dao\Mnt;
use Dao\Table;

class Roles extends Table{

    /*
    `rolescod` 
  `rolesdsc` 
  `rolesest` 
   */


   /**
     * Obtiene todos los registros de Roles
     *
     * @return array
     */
    public static function getAll()
    {
        $sqlstr = "Select * from roles;";
        return self::obtenerRegistros($sqlstr, array());
    }

      /**
     * Get Score By Id
     *
     * @param varchar $rolescod Codigo del rol
     *
     * @return array
     */
    public static function getById($rolescod)
    {
        $sqlstr = "SELECT * from `roles` where rolescod=:rolescod;";
        $sqlParams = array("rolescod" => $rolescod);
        return self::obtenerUnRegistro($sqlstr, $sqlParams);
    }


    /**
     * Insertar Roles
     *
     * @param [Varchar] $rolescod codigo del Rol
     * @param [Varchar] $rolesdsc Descripcion del Rol
     * @param [Varchar] $rolesest Estado del Rol
     * @return void
     */
    public static function insert(
        $rolescod,
        $rolesdsc,
        $rolesest
    )
    {
        $sqlstr = "INSERT INTO `roles`
        (`rolescod`,
        `rolesdsc`,
        `rolesest`)
        VALUES
        (:rolescod,
        :rolesdsc,
        :rolesest);
        ";

        $sqlParams = array(
            "rolescod" => $rolescod,
            "rolesdsc" => $rolesdsc,
            "rolesest" => $rolesest
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
        
    }
/**
 * Funcion de actualizar Roles
 *
 * @param [Varchar] $rolescod codigo del Rol
 * @param [Varchar] $rolesdsc Descripcion del Rol
 * @param [Varchar] $rolesest Estado del Rol
 * @return void
 */
    public static function update(
        $rolescod,
        $rolesdsc,
        $rolesest
    )
    {
        $sqlstr = "UPDATE `roles`
        SET
        `rolescod` = :rolescod,
        `rolesdsc` = :rolesdsc,
        `rolesest` = :rolesest 
        WHERE `rolescod` = :rolescod;
        ";

        $sqlParams = array(
            "rolescod" => $rolescod,
            "rolesdsc" => $rolesdsc,
            "rolesest" => $rolesest
        );

        return self::executeNonQuery($sqlstr, $sqlParams);
    }
/**
 * Eliminar Roles
 *
 * @param [Varchar] $rolescod
 * @return void
 */
    public static function delete($rolescod){
        $sqlstr = "DELETE from `roles` where rolescod = :rolescod;";
        $sqlParams = array(
            "rolescod" => $rolescod
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }


}
?>