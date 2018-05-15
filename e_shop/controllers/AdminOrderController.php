<?php
/**
 * Created by PhpStorm.
 * User: rudnyk
 * Date: 09.05.18
 * Time: 13:41
 */

class AdminOrderController extends AdminBase
{
    public function actionIndex(){

        self::checkAdmin();
        $ordersList = Order::getOrdersList();

        require_once (ROOT ."/views/admin_order/index.php");

        return true;
    }


    public function actionView($id){

        self::checkAdmin();
        $order = Order::getOrderById($id);

        //get array with id of products and count item
        $productsQuantity = json_decode($order['products'],true);

        $productsIds = array_keys($productsQuantity);

        $products = Product::getProductsByIds($productsIds);



        require_once (ROOT ."/views/admin_order/view.php");

        return true;
    }

}
