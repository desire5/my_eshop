<?php
/**
 * Created by PhpStorm.
 * User: rudnyk
 * Date: 04.05.18
 * Time: 17:19
 */

class CabinetController
{
    public function actionIndex()
    {
        $userId = User::checkLogged();

        $user = User::getUserById($userId);
        //echo $user['name'];

        require_once (ROOT .'/views/cabinet/index.php');

        return true;
    }

    public function actionEdit()
    {
        //take id user from session
        $userId = User::checkLogged();

        $user = User::getUserById($userId);
        $name = $user['name'];
        $password = $user['password'];

        $result = false;

        if(isset($_POST['submit']))
        {
            $name = $_POST['name'];
            $password = $_POST['password'];

            $errors = false;

            if(!User::checkName($name))
                $errors[] = "name does not be less 3 liter";

            if(!User::checkPassword($password))
                $errors[] = "password does not be less 6 liter";

            if($errors == false)
            {
                $result = User::edit($userId, $name, $password);
            }
        }

        require_once (ROOT .'/views/cabinet/edit.php');

        return true;
    }
}