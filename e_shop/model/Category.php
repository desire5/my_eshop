<?php
/**
 * Created by PhpStorm.
 * User: rudnyk
 * Date: 03.05.18
 * Time: 11:59
 */

//namespace e_shop\model;

//use e_shop\components; // DB and Router

class Category
{

    const SHOW_BY_DEFAULT = 3;

    public static function getCategoriesList()
    {
        $db = DB::getConnection();

        $categoryList = array();

        $result = $db->query("SELECT id, name, sort_order, status FROM category ORDER BY sort_order ASC ");

        foreach ($result as $id => $item)
        {
            $categoryList[$id]['id'] = $item["id"];
            $categoryList[$id]['name'] = $item["name"];
            $categoryList[$id]['sort_order'] = $item["sort_order"];
            $categoryList[$id]['status'] = $item["status"];

        }

        return $categoryList;
    }

    public static function getProductsListByCategory($category_id = false,$page = 1)
    {
        $count = self::SHOW_BY_DEFAULT;
        $page = intval($page);
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        $db = DB::getConnection();
        $products = array();
        $result = $db->query("SELECT * FROM product WHERE  category_id =  $category_id LIMIT $count OFFSET $offset" );


//        $result = $db->query("SELECT * FROM product"
//            . "WHERE status = '1' AND category_id = {$category_id}"
//            . "ORDER BY id ASC "
//            . "LIMIT ".self::SHOW_BY_DEFAULT
//            .'OFFSET '. $offset);
//
        foreach ($result as $id => $item)
        {
            $products[$id]['id'] = $item["id"];
            $products[$id]['name'] = $item["name"];
            $products[$id]['price'] = $item["price"];
            $products[$id]['is_new'] = $item["is_new"];
        }

        return $products;

    }

    public static function getTotalProductsInCategory($category_id)
    {
        $db = DB::getConnection();
        $result = $db->query("SELECT count(id) AS count FROM product WHERE  status='1' AND category_id =  $category_id" );
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }

    public static function getTotalProducts()
    {
        $db = DB::getConnection();
        $result = $db->query("SELECT count(id) AS count FROM product WHERE  status='1' " );
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }

}