<?php

//include_once ROOT. '/model/Category.php';
//include_once ROOT. '/model/Product.php';
//include_once ROOT. '/components/Pagination.php';


class CatalogController
{
    public function actionIndex($page=1)
    {
        $categories = array();
        $categories = Category::getCategoriesList();

        $latestProducts = array();
        $latestProducts = Product::getLatestProducts(Product::SHOW_BY_DEFAULT,$page);

// total pagination
        $total = Category::getTotalProducts();
        //echo $total;
        $pagination = new Pagination($total,$page ,Product::SHOW_BY_DEFAULT,'page-');


        require_once(ROOT ."/views/catalog/index.php");

        return true;
    }



    public function actionCategory($category_id, $page=1)
    {
        echo "page - ". $page."<br>";
        echo "category - ". $category_id;
        $categories = array();
        $categories = Category::getCategoriesList();

        $categoryProducts = array();
        $categoryProducts = Category::getProductsListByCategory($category_id, $page);

        $total = Category::getTotalProductsInCategory($category_id);

        $pagination = new Pagination($total,$page,Product::SHOW_BY_DEFAULT,'page-');

        require_once (ROOT ."/views/catalog/category/index.php");

        return true;

    }
}