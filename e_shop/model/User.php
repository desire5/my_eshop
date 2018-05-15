<?php
/**
 * Created by PhpStorm.
 * User: rudnyk
 * Date: 04.05.18
 * Time: 13:05
 */

class User
{
    public static function register($name, $email, $password)
    {
        $db = DB::getConnection();

        $sql = 'INSERT INTO user (name, email, password)'
            . 'VALUES (:name, :email, :password)';
        $result = $db->prepare($sql);
        $result->bindParam(':name',$name, PDO::PARAM_STR);
        $result->bindParam(':email',$email, PDO::PARAM_STR);
        $result->bindParam(':password',$password, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function checkName($name)
    {
        if(strlen($name)>=3)
        {
            return true;
        }
        return false;
    }

    public static function checkPassword($password)
    {
        if(strlen($password)>=6)
        {
            return true;
        }
        return false;
    }

    public static function checkEmail($email)
    {
        if(filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            return true;
        }
        return false;
    }

    public static function checkEmailExists($email)
    {
        $db = DB::getConnection();

       $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';
       $result = $db->prepare($sql);
       $result->bindParam(':email', $email, PDO::PARAM_STR);
       $result->execute();

        if($result->fetchColumn())
            return true;
        return false;
    }

    public static function checkUserExists($email,$password)
    {
        $db = DB::getConnection();

        $sql = 'SELECT * FROM user WHERE email = :email AND password = :password';
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();
        if($user)
            return $user['id'];

        return false;
    }

    // zapamyatovuem user
    public static function auth($userId)
    {
        session_start();
        $_SESSION['user'] = $userId;
    }

    public static function checkLogged()
    {
        //session_start();
        // if this session exist then return id of user - $_SESSION['user'] = $userId;
        if(isset($_SESSION['user']))
        {
            return $_SESSION['user'];
        }
        header("Location: /e_shop/?user/login");
    }

    public static function isGuest()
    {
        //session_start();
        if (isset($_SESSION['user']))
        {
            return false;
        }

        return true;
    }

    public static function getUserById($userId)
    {
        $db = DB::getConnection();

        $sql = 'SELECT * FROM user WHERE id = :userId';
        $result = $db->prepare($sql);
        $result->bindParam(':userId', $userId, PDO::PARAM_INT);
        $result->execute();

        $user = $result->fetch();

        return $user;

    }

    public static function edit($idUser, $name, $password)
    {
        $db = DB::getConnection();

        $sql = 'UPDATE user 
          SET name= :name, password = :password
          WHERE id = :idUser';
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':idUser', $idUser, PDO::PARAM_INT);


        return $result->execute();

    }

}