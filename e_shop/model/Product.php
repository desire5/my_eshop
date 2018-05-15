<?php
/**
 * Created by PhpStorm.
 * User: rudnyk
 * Date: 03.05.18
 * Time: 13:41
 */
//use e_shop\components;
//namespace \product;
class Product
{
    const SHOW_BY_DEFAULT = 3;

    /**
     * returns an array of products
     */
    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT,$page=1)
    {   $page=intval($page);
        $offset = ($page - 1)*$count;

        $db = DB::getConnection();

        $result = $db->query("SELECT * FROM product WHERE status ='1' ORDER BY id DESC LIMIT $count OFFSET $offset");
        $productsList = array();
        foreach ($result as $id=>$item)
        {
            $productsList[$id]['id'] = $item['id'];
            $productsList[$id]['name'] = $item['name'];
            $productsList[$id]['price'] = $item['price'];
            $productsList[$id]['is_new'] = $item['is_new'];

        }
        return $productsList;
    }

    public static function getProductsList()
    {
        $db = DB::getConnection();

        $result = $db->query("SELECT * from product WHERE status = '1' ORDER BY id DESC");

        $productsList = array();
        foreach ($result as $id=>$item)
        {
            $productsList[$id]['id'] = $item['id'];
            $productsList[$id]['name'] = $item['name'];
            $productsList[$id]['price'] = $item['price'];
            $productsList[$id]['is_new'] = $item['is_new'];
            $productsList[$id]['code'] = $item['code'];
        }
        return $productsList;

    }
    // recommended of product SLIDER
//    public static function getRecommended()
//    {
//
//        $db = DB::getConnection();
//
//        $result = $db->query("SELECT * FROM product WHERE status ='1' AND is_recommended = '1' ");
//        $productsList = array();
//        foreach ($result as $id=>$item)
//        {
//            $productsList[$id]['id'] = $item['id'];
//            $productsList[$id]['name'] = $item['name'];
//            $productsList[$id]['price'] = $item['price'];
//            $productsList[$id]['is_new'] = $item['is_new'];
//
//        }
//        return $productsList;
//    }

    public static function getProductById($id)
    {
        $id = intval($id);
        if ($id) {
//
            $db = DB::getConnection();

            $result = $db->query("Select * FROM product
                   WHERE id =" . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            $productItem = $result->fetch();

            return $productItem;

        }
    }

    // get all products from Session
    public static function getProductsByIds($idsArray)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Превращаем массив в строку для формирования условия в запросе
        $idsString = implode(',', $idsArray);

        // Текст запроса к БД
        $sql = "SELECT * FROM product WHERE status='1' AND id IN ($idsString)";

        $result = $db->query($sql);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Получение и возврат результатов

        $products = array();
        foreach ($result as $i=>$row)
        {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];

        }
        return $products;
    }


    // all products in database for parameter of pagination
    public static function getTotalProducts()
    {
        $db = DB::getConnection();
        $result = $db->query("SELECT count(id) AS count FROM product WHERE  status=1 " );
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }

    public static function createProduct($options)
    {
        $db = DB::getConnection();

        $sql = 'INSERT INTO product '
            . '(name, code, price, category_id, brand, availability,'
            . 'description, is_new, is_recommended, status)'
            . 'VALUES '
            . '(:name, :code, :price, :category_id, :brand, :availability,'
            . ':description, :is_new, :is_recommended, :status)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;

    }

    //update product by id. $options - are array from form
    public static function updateProductById($id,$options)
    {
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE product
            SET 
                name = :name, 
                code = :code, 
                price = :price, 
                category_id = :category_id, 
                brand = :brand, 
                availability = :availability, 
                description = :description, 
                is_new = :is_new, 
                is_recommended = :is_recommended, 
                status = :status
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        return $result->execute();
    }

    public static function deleteProductById($id)
    {
        $db = DB::getConnection();

        $sql = "DELETE FROM product WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(":id",$id,PDO::PARAM_INT);
        return $result->execute();
        }

    /**
     * Возвращает путь к изображению
     * @param integer $id
     * @return string <p>Путь к изображению</p>
     */
    public static function getImage($id)
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';

        // Путь к папке с товарами
        $path = '/e_shop/upload/images/products/';

        // Путь к изображению товара
        $pathToProductImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        }

        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }
}