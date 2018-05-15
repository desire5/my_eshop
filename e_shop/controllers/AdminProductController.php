<?php
/**
 * Created by PhpStorm.
 * User: rudnyk
 * Date: 09.05.18
 * Time: 10:42
 */

class AdminProductController extends AdminBase
{

    public function actionIndex()
    {   // check out dostup
        self::checkAdmin();

        $productsList = Product::getProductsList();

        require_once (ROOT ."/views/admin_product/index.php");

        return true;

    }

  public function actionCreate()
  {
      self::checkAdmin();

      $categoriesList = Category::getCategoriesList();

      if(isset($_POST['submit']))
      { //if for has sent
          //then get data from form
        $options['name'] = $_POST['name'];
        $options['code'] = $_POST['code'];
          $options['price'] = $_POST['price'];
          $options['category_id'] = $_POST['category_id'];
          $options['brand'] = $_POST['brand'];
          $options['availability'] = $_POST['availability'];
          $options['description'] = $_POST['description'];
          $options['is_recommended'] = $_POST['is_recommended'];
          $options['is_new'] = $_POST['is_new'];
          $options['status'] = $_POST['status'];

          $errors= false;
          if(!isset( $options['name']) || empty( $options['name']))
          {
              $errors[] ="Enter field";
          }

          if($errors == false)
          {
              $id = Product::createProduct($options);

              if($id)
              {
                  if(is_uploaded_file($_FILES['image']['tmp_name']))
                  {
                      move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/upload/images');
                  }
              }

              header("Location: /e_shop/?admin/product");
          }

      }



      require_once (ROOT."/views/admin_product/create.php");

      return true;
  }

// update
    public function actionUpdate($id)
    {
        self::checkAdmin();
       $product = Product::getProductById($id);

        $categoriesList = Category::getCategoriesList();

        if(isset($_POST["submit"]))
        {
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['is_new'] = $_POST['is_new'];
            $options['status'] = $_POST['status'];


           if( Product::updateProductById($id,$options))
           {
               // Если запись сохранена
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {

                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                    move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                }

           }
            header("Location: /e_shop/?admin/product");
        }


       require_once (ROOT."/views/admin_product/update.php");

        return true;
    }


    // delete
    public function actionDelete($id)
    {
        self::checkAdmin();

        if(isset($_POST['submit']))
        {
            Product::deleteProductById($id);

            header("Location: /e_shop/?admin/product");
        }

        require_once (ROOT ."/views/admin_product/delete.php");

        return true;
    }


}