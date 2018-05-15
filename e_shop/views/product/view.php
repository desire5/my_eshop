<?include ROOT. "/layouts/header.php";?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Каталог</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            <?foreach($categoryList as $categoryItem):?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><a href="/e_shop/?category/<?=$categoryItem['id']; ?>">
                                                <?=$categoryItem['name'];?></a></h4>
                                    </div>
                                </div>
                            <?endforeach;?>
                        </div>
                        </div><!--/category-products-->

                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="product-details"><!--product-details-->
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="view-product">
                                    <img src="<?echo Product::getImage($productItem['id'])?>" alt="" />
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <?//print_r($productItem);?>
                                <div class="product-information"><!--/product-information-->
                                    <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                                    <h2><?=$productItem['name']; ?></h2>
                                    <p>Код товара: <?=$productItem['code']; ?></p>
                                    <span>
                                            <span><?=$productItem['price']; ?></span>
                                            <label>Количество:</label>
                                            <input type="text" value="<?=$productItem['availability']; ?>" />
                                            <button type="button" class="btn btn-fefault cart">
                                                <i class="fa fa-shopping-cart"></i>
                                                В корзину
                                            </button>
                                        </span>
                                    <p><b>Наличие:</b> На складе</p>
                                    <p><b>Состояние:</b> Новое</p>
                                    <p><b>Производитель:</b> <?=$productItem['brand']; ?></p>
                                </div><!--/product-information-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h5>Описание товара</h5>
                                <p><?=$productItem['description']; ?></p>
                            </div>
                        </div>
                    </div><!--/product-details-->

                </div>
            </div>
        </div>
    </section>

<?include ROOT. "/layouts/footer.php";?>