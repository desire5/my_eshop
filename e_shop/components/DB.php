<?php
/**
 * Created by PhpStorm.
 * User: rudnyk
 * Date: 02.05.18
 * Time: 12:24
 */
//namespace e_shop\components;

class DB
{
    public static function getConnection()
    {
        $paramsPath = ROOT. '/config/db_conn.php';
        $params = include($paramsPath);

        $db = new PDO("mysql:host={$params["host"]}; dbname={$params['dbname']}",
            $params['user'], $params['password']);
        $db->exec("set names utf8");

        return $db;
    }
}