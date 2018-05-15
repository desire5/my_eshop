<?
return array(

    // *** important order of routes ***

    //"product/page-([0-9])" => "product/index", use without page-
    "product/page-([0-9])" => "product/index/$1", // with page-
    "product/([0-9]+)" => "product/view/$1", //actionView at ProductController
    //"product" => "product/index", //actionIndex at ProductController
//here wanted make pagination
    "catalog/page-([0-9])" => "catalog/index/$1", // actionIndex in CatalogController

    // important order of routes
    "category/([0-9]+)/page-([0-9]+)" => "catalog/category/$1/$2", //actionCategory CatalogController
    "category/([0-9]+)" => "catalog/category/$1", //actionCategory CatalogController


    //"category"

    "user/register" => "user/register", //actionRegister in UserController
    'user/login'=>"user/login",
    'user/logout'=>'user/logout',


//cart
    //synchronous query
    'cart/add/([0-9]+)'=>'cart/add/$1', // cart  actionAdd in CartController
    //Asynchronous query. try use when  urlrewrite be ok
   // 'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1',
    "cart/checkout"=> "cart/checkout", // actionCheckout в CartController
    "cart/delete/([0-9]+)"=> "cart/delete/$1", // actionDelete в CartController
    'cart' => 'cart/index', // actionIndex в CartController

    'cabinet/edit'=>'cabinet/edit',
    'cabinet'=>'cabinet/index', // in header Accaunt

    'contacts'=> 'site/contact',


    // Admin



    //manager products
    "admin/product/create"=>"adminProduct/create",
    "admin/product/delete/([0-9])"=>"adminProduct/delete/$1",
    "admin/product/update/([0-9])"=>"adminProduct/update/$1",

    "admin/product"=>"adminProduct/index",


    // manager order
    "admin/order/view/([0-9])"=>"adminOrder/view/$1",
    "admin/order"=>"adminOrder/index",


// this must be last
    "admin"=> "admin/index", //actionIndex in adminController


    //'' => 'site/index',
    'e_shop' => 'site/index', //actionIndex in SiteController
);
