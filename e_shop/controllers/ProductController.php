<?php

//namespace e_shop\controllers;

//include_once ROOT. '/model/Category.php';
//include_once ROOT. '/model/Product.php';
//include_once ROOT. '/components/Pagination.php';

//use e_shop\model\Category;
//use e_shop\model;

class ProductController
{

    public function actionIndex($page=1)
    {
       $categoryList = Category::getCategoriesList(); // get list of categories

       $productsList = Product::getLatestProducts(PRODUCT::SHOW_BY_DEFAULT,$page);

       //$productRecommended = Product::getRecommended();

       $total = Product::getTotalProducts();

       $pagination = new Pagination($total,$page,Product::SHOW_BY_DEFAULT,'page-');
       require_once(ROOT. '/views/product/index.php');

       return true;
    }

    public function actionView($id)
    {
        $categoryList = Category::getCategoriesList();

        $productItem = Product::getProductById($id);

        require_once (ROOT. "/views/product/view.php");

        return true;
    }


}