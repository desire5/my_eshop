<?php
/**
 * Created by PhpStorm.
 * User: rudnyk
 * Date: 08.05.18
 * Time: 17:18
 */

class AdminController extends AdminBase
{

    public function actionIndex()
    {
        self::checkAdmin();

        require_once (ROOT. '/views/admin/index.php');
        return true;
    }
}