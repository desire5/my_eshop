<?php
/**
 * Created by PhpStorm.
 * User: rudnyk
 * Date: 07.05.18
 * Time: 10:37
 */

class Cart
{

    // synchronous query
    public static function addProduct($id)
    {
        $id = intval($id);

        //empty array for our cart
        $productInCart = array();

        if (isset($_SESSION['products'])) {
            $productInCart = $_SESSION["products"];
        }

        //if exist id in our $productInCart then add 1 yet (++)
        if (array_key_exists($id, $productInCart)) {
            $productInCart[$id]++;

        } // add new product
        else {
            $productInCart[$id] = 1;
        }

        $_SESSION['products'] = $productInCart;
        //echo '<pre>'; print_r($_SESSION['products']); die();

        return self::countItems();

    }

    public static function countItems()
    {
        if (isset($_SESSION['products'])) {
            $count = 0;
            foreach ($_SESSION['products'] as $product) {
                $count += $product;
            }

            return $count;
        } else {
            return 0;
        }

    }

    /**
     * Возвращает массив с идентификаторами и количеством товаров в корзине<br/>
     * Если товаров нет, возвращает false;
     * @return mixed: boolean or array
     */
    public static function getProducts()
    {
        if (isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return false;
    }

    /**
     * Получаем общую стоимость переданных товаров
     * @param array $products <p>Массив с информацией о товарах</p>
     * @return integer <p>Общая стоимость</p>
     */
    public static function getTotalPrice($products)
    {
        // Получаем массив с идентификаторами и количеством товаров в корзине
        $productsInCart = self::getProducts();

        // Подсчитываем общую стоимость
        $total = 0;
        if ($productsInCart) {
            // Если в корзине не пусто
            // Проходим по переданному в метод массиву товаров
            foreach ($products as $key => $item) {
                // Находим общую стоимость: цена товара * количество товара
                $total = $total + $item['price'] * $productsInCart[$item['id']];
                //$total = $key;
            }
        }

        return $total;
    }

   // who knew
    public static function getTotalPriceByItem($products)
    {
        // Получаем массив с идентификаторами и количеством товаров в корзине
        $productsInCart = self::getProducts();

        // Подсчитываем общую стоимость
        $totalItem = 1;
        if ($productsInCart) {
            // Если в корзине не пусто
            // Проходим по переданному в метод массиву товаров
            foreach ($products as $key=>$item) {
                // Находим общую стоимость 1 tovara: цена товара * количество товара
                $totalItem = $products[$key]['price'] * $products[$key]['id'];
                return $totalItem;
            }
        }
    }

    public static function clear()
    {
        if(isset($_SESSION['products']))
            unset($_SESSION['products']);
    }

    public static function deleteFromCatById($id)
    {
        $productsInCart = Cart::getProducts();

       unset($productsInCart[$id]);

       $_SESSION['products'] = $productsInCart;
    }

}