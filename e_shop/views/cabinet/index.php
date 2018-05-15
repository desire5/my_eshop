<?php include ROOT . '/layouts/header.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <h3>Кабинет пользователя</h3>

                <h4>Привет, <?echo $user['name'];?>!</h4>
                <ul>
                    <li><a href="/e_shop/?cabinet/edit">Редактировать данные</a></li>
                    <li><a href="/e_shop/?cabinet/history">Список покупок</a></li>
                </ul>

            </div>
        </div>
    </section>

<?php include ROOT . '/layouts/footer.php'; ?>