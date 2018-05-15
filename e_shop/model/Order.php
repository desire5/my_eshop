<?php
/**
 * Created by PhpStorm.
 * User: rudnyk
 * Date: 08.05.18
 * Time: 12:06
 */

class Order
{
    public static function save($userName, $userPhone, $userComment, $userId, $products)
    {
        $products = json_encode($products);


        $db = DB::getConnection();

        $sql = 'INSERT INTO product_order (user_name, user_phone, user_comment, user_id, products)'
            . 'VALUES (:user_name, :user_phone, :user_comment, :user_id, :products)';
        $result = $db->prepare($sql);
        $result->bindParam(':user_name',$userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone',$userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment',$userComment, PDO::PARAM_STR);
        $result->bindParam(':user_id',$userId, PDO::PARAM_STR);
        $result->bindParam(':products',$products, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function getOrdersList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT id, user_name, user_phone, date, status FROM product_order ORDER BY id DESC');
        $ordersList = array();

        foreach ($result as $i=>$row)
        {
            $ordersList[$i]['id'] = $row['id'];
            $ordersList[$i]['user_name'] = $row['user_name'];
            $ordersList[$i]['user_phone'] = $row['user_phone'];
            $ordersList[$i]['date'] = $row['date'];
            $ordersList[$i]['status'] = $row['status'];

        }
        return $ordersList;
    }


    /**
     * Возвращает заказ с указанным id
     * @param integer $id <p>id</p>
     * @return array <p>Массив с информацией о заказе</p>
     */
    public static function getOrderById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM product_order WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполняем запрос
        $result->execute();

        // Возвращаем данные
        return $result->fetch();
    }


    public static function getStatusText($status)
    {
        switch($status)
        {
            case'1':
                return "New order";
                break;
            case'2':
                return "in process";
                break;
            case'3':
                return "Delivering";
                break;
            case'4':
                return "close";
                break;

        }
    }


}