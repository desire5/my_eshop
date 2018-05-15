<?php
/**
 * Created by PhpStorm.
 * User: rudnyk
 * Date: 02.05.18
 * Time: 15:56
 */
//namespace e_shop\controllers;

class SiteController
{
    public function actionIndex()
    {
        require_once(ROOT. '/views/site/index.php');

        return true;
    }

    public function actionContact()
   {
       $userEmail = "";
       $userText='';
       $result =''; // for template

       if(isset($_POST['submit']))
       {
           $errors = false;

           $userEmail = $_POST['userEmail'];
           $userText = $_POST['userText'];

           if(!User::checkEmail($userEmail))
           {
               $errors[] = "wrong your email";

           }

           if($errors == false)
           {
               $adminEmail = 'ant23james23@gmail.com';
               $subject = "2bla bla";
               $message = "Text: {$userText} . From {$userEmail}";
               $result = mail($adminEmail, $subject, $message);
               $result = true;

           }

       }
       require_once (ROOT .'/views/site/contact.php');

       return true;
    }
}