<?php
/**
 * Created by PhpStorm.
 * User: rudnyk
 * Date: 04.05.18
 * Time: 12:51
 */

class UserController
{
    public function actionRegister()
    {
        $name ='';
        $email='';
        $password='';
        $result = false;

        if(isset($_POST['submit']))
        {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
        }

        $errors = false;

        if(!User::checkName($name))
            $errors[] = "name does not be less 3 liter";

        if(!User::checkEmail($email))
            $errors[] = "wrong email";

        if(!User::checkPassword($password))
            $errors[] = "password does not be less 6 liter";

        if(User::checkEmailExists($email))
            $errors[] = "this email is exist";

        if($errors == false)
        {   //save user
            $result = User::register($name,$email,$password);

        }

        require_once (ROOT. '/views/user/register.php');

        return true;
    }

    public function actionLogin()
    {

        $email='';
        $password='';
        $result = false;

        if(isset($_POST['submit']))
        {
            $email = $_POST['email'];
            $password = $_POST['password'];
        }

        $errors = false;


        if(!User::checkEmail($email))
            $errors[] = "wrong email";

        if(!User::checkPassword($password))
            $errors[] = "password does not be less 6 liter";

        $userId = User::checkUserExists($email,$password);
        if($userId==false)
            $errors[] = "wrong data(email and password) for enter to site";
        else {
            // if all good. remember user (session)
            User::auth($userId);

            // render user in privat cabinet
            header("Location: /e_shop/?cabinet/");
        }
//here continue
        require_once (ROOT. '/views/user/login.php');

        return true;
    }

    public function actionLogout()
    {
        session_start();
        unset($_SESSION['user']);
        header("Location: /e_shop/?product/page-1");

    }
}