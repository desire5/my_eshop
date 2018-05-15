<?php
/**
 * Created by PhpStorm.
 * User: rudnyk
 * Date: 08.05.18
 * Time: 17:28
 */

abstract class AdminBase
{

     public static function checkAdmin()
    {

      $userId = User::checkLogged();

      $user = User::getUserById($userId);


      if($user['role'] == "admin")
      {
          return true;
      }

      die("ACCESS DENIED");

    }
}