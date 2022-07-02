<?php

namespace Dao\Mnt;
use Dao\Table;

class usuarios extends Table
{
    public static function getAll()
    {
        $sqlstr = "select * from usuario;";
        return self::obtenerRegistros($sqlstr, array());
    }

    public static function getById(int $usercod)
    {
        $sqlstr = "SELECT * from `usuario` where usercod=:usercod;";
        $sqlParams = array("usercod" => $usercod);
        return self::obtenerUnRegistro($sqlstr, $sqlParams);
    }

    public static function insert($useremail,$username,$userpswd,$userfching,$userpswdest,$userpswdexp,$userest,$useractcod,$userpswdchg,$usertipo){

        $sqlstr = "INSERT INTO `nw202202`.`usuario`
        (`useremail`,
        `username`,
        `userpswd`,
        `userfching`,
        `userpswdest`,
        `userpswdexp`,
        `userest`,
        `useractcod`,
        `userpswdchg`,
        `usertipo`)
        VALUES
        (:useremail,
        :username,
        :userpswd,
        :userfching,
        :userpswdest,
        :userpswdexp,
        :userest,
        :useractcod,
        :userpswdchg,
        :usertipo);";

        $sqlParams = [
            "useremail" => $useremail,
            "username" => $username,
            "userpswd" => $userpswd,
            "userfching" => $userfching,
            "userpswdest" => $userpswdest, 
            "userpswdexp" => $userpswdexp,
            "userest" => $userest,
            "useractcod"   => $useractcod,
            "userpswdchg"  => $userpswdchg,
            "usertipo"     => $usertipo
        ];

        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    public static function update($useremail,$username,$userpswd,$userfching,$userpswdest,$userpswdexp,$userest,$useractcod,$userpswdchg,$usertipo,$usercod) {
        $sqlstr = "UPDATE `nw202202`.`usuario`
        SET
        `usercod` = :usercod ,
        `useremail` = :useremail,
        `username` = :username,
        `userpswd` = :userpswd,
        `userfching` = :userfching,
        `userpswdest` = :userpswdest,
        `userpswdexp` = :userpswdexp,
        `userest` = :userest,
        `useractcod` = :useractcod,
        `userpswdchg` = :userpswdchg,
        `usertipo` = :usertipo
        WHERE `usercod` = :usercod;";

        $sqlParams = [
            "useremail" => $useremail,
            "username" => $username,
            "userpswd" => $userpswd,
            "userfching" => $userfching,
            "userpswdest" => $userpswdest,
            "userpswdexp" => $userpswdexp,
            "userest" => $userest,
            "useractcod" => $useractcod,
            "userpswdchg" => $userpswdchg,
            "usertipo" => $usertipo,
            "usercod" => $usercod
        ];
        
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    public static function delete($usercod){
        $sqlstr = "DELETE from `usuario` where usercod=:usercod;";
        
        $sqlParams = [
            "usercod" => $usercod
        ];

        return self::executeNonQuery($sqlstr, $sqlParams);
    }
}
?>