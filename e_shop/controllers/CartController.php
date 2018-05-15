<?php
/**
 * Created by PhpStorm.
 * User: rudnyk
 * Date: 07.05.18
 * Time: 10:26
 */

//use \product;
class CartController
{
    //Synchronous query
    public function actionAdd($id)
    {
        Cart::addProduct($id);

         //return user to page
        $referrer = $_SERVER["HTTP_REFERER"];
        header("Location: $referrer");
    }


    /**
     * Action для добавления товара в корзину при помощи асинхронного запроса (ajax)
     * @param integer $id <p>id товара</p>
     */
//    public function actionAddAjax($id)
//    {
//        // Добавляем товар в корзину и печатаем результат: количество товаров в корзине
//        echo Cart::addProduct($id);
//        return true;
//    }
    //Asynchronous query
//    public function actionAddAjax($id)
//    {
//        echo json_encode(Cart::addProduct($id));
//        return true;
//    }

    public function actionIndex()
    {
        $categories= array();

        $categories = Category::getCategoriesList();

        $productsInCart = false;
        //take data from cart
        $productsInCart = Cart::getProducts();


        if($productsInCart)
        {
            $productsIds = array_keys($productsInCart);
            //die();
            $products = Product::getProductsByIds($productsIds);

            //take total price of items
            $total = Cart::getTotalPrice($products);
           // $totalItem = Cart::getTotalPriceByItem($products);
        }

        require_once(ROOT ."/views/cart/index.php");

        return true;

    }
    public function actionCheckout()
    {
        // Получием данные из корзины
        $productsInCart = Cart::getProducts();

        // Если товаров нет, отправляем пользователи искать товары на главную
        if ($productsInCart == false) {
            header("Location: /");
        }

        // Список категорий для левого меню
        $categories = Category::getCategoriesList();

        // Находим общую стоимость
        $productsIds = array_keys($productsInCart);
        $products = Product::getProductsByIds($productsIds);
        $totalPrice = Cart::getTotalPrice($products);

        // Количество товаров
        $totalQuantity = Cart::countItems();

        // Поля для формы
        $userName = false;
        $userPhone = false;
        $userComment = false;

        // Статус успешного оформления заказа
        $result = false;

        // Проверяем является ли пользователь гостем
        if (!User::isGuest()) {
            // Если пользователь не гость
            // Получаем информацию о пользователе из БД
            $userId = User::checkLogged();
            $user = User::getUserById($userId);
            $userName = $user['name'];
        } else {
            // Если гость, поля формы останутся пустыми
            $userId = false;
        }

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];

            // Флаг ошибок
            $errors = false;

            // Валидация полей
            if (!User::checkName($userName)) {
                $errors[] = 'Неправильное имя';
            }
//            if (!User::checkPhone($userPhone)) {
//                $errors[] = 'Неправильный телефон';
//            }


            if ($errors == false) {
                // Если ошибок нет
                // Сохраняем заказ в базе данных
                $result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart);

                if ($result) {
                    // Если заказ успешно сохранен
                    // Оповещаем администратора о новом заказе по почте
                    $adminEmail = 'ant23james23@gmai.com';
                    $message = '<a href = "http://test-dev-vv5.devplace.info/e_shop/?admin/orders">Список заказов</a>';
                    $subject = 'Новый заказ!';
                    mail($adminEmail, $subject, $message);

                    // Очищаем корзину
                    Cart::clear();
                }
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/cart/checkout.php');
        return true;
    }

    public function actionDelete($id)
    {
        Cart::deleteFromCatById($id);

        $referrer = $_SERVER["HTTP_REFERER"];
        header("Location: $referrer");

        return true;

    }
}