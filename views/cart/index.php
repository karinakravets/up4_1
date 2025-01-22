<?php

use app\models\Cart;
use app\models\Good;
use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CartSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Корзина';
?>
<div class="cart-index">

    <h1 class="mt-4"><?= Html::encode($this->title) ?></h1>

    <script>
        function add_product(id, items) {
            let form = new FormData();
            form.append('product_id', id);
            form.append('count', items);
            let request_options = {
                method: 'POST',
                body: form
            };

            fetch('https://exam-kravetc.xn--80ahdri7a.site/cart/create', request_options)
                .then(response => response.text())
                .then(result => {
                    let title = document.getElementById('staticBackdropLabel');
                    let body = document.getElementById('modalBody');
                    if (result == false) {
                        title.innerText = 'Ошибка';
                        body.innerHTML = "<p>Ошибка добавления товара, возможно, товар уже раскупили</p>"
                    } else {
                        title.innerText = 'Информационное сообщение';
                        body.innerHTML = "<p>Товар успешно добавлен в корзину</p>"
                    }
                    let myModal = new bootstrap.Modal(document.getElementById("staticBackdrop"), {});
                    myModal.show();
                })
        }
        function remove_product(id) {
            let form = new FormData();
            form.append('good_id', id);
            let request_options = {
                method: 'POST',
                body: form
            };
            fetch('https://exam-kravetc.xn--80ahdri7a.site/cart/remove-item', request_options)
                .then(response => response.text())
                .then(result => {
                    let title = document.getElementById('staticBackdropLabel');
                    let body = document.getElementById('modalBody');
                    if (result == false) {
                        title.innerText = 'Ошибка';
                        body.innerHTML = "<p>Ошибка удаления товара</p>"
                    } else {
                        title.innerText = 'Информационное сообщение';
                        body.innerHTML = "<p>Товар успешно удален</p>"
                    }
                    let myModal = new bootstrap.Modal(document.getElementById("staticBackdrop"), {});
                    myModal.show();
                })
        }

        function order() {
            let request_options = {
                method: 'POST'
            };

            fetch('https://exam-kravetc.xn--80ahdri7a.site/order/create', request_options)
                .then(response => response.text())
                .then(result => {
                    let title = document.getElementById('staticBackdropLabel');
                    let body = document.getElementById('modalBody');
                    if (result == false) {
                        title.innerText = 'Ошибка';
                        body.innerHTML = "<p>Ошибка удаления товара</p>"
                    } else {
                        title.innerText = 'Информационное сообщение';
                        body.innerHTML = "<p>Товар успешно удален</p>"
                    }
                    let myModal = new bootstrap.Modal(document.getElementById("staticBackdrop"), {});
                    myModal.show();
                })
        }

        function onSubmit() {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        }
    </script>

    <?php
    $carts = Cart::find()->where(['id_user' => Yii::$app->user->id, 'id_order' => null])->all();
    $products = [];
    foreach ($carts as $cart) {
        $cart_prod = Product::findOne($cart->id_product)->toArray();
        $cart_prod['count'] = $cart->count;
        array_push($products, $cart_prod);
    }
    echo "<div class='d-flex flex-row flex-wrap justify-content-start align-itemsend'>";
    foreach ($products as $product) {
        echo "<div class='card m-1' style='width: 22%; min-width: 300px;'>
            <a href='/product/view?id={$product['id_product']}' style='height: 300px; width: 300px; background-position: center; background-size: cover; background-repeat: no-repeat; background-image: url(http://exam-kravetc.xn--80ahdri7a.site/{$product['photo']})'></a>
            <div class='card-body'>
            <h5 class='card-title'>{$product['name']}</h5>
            <p class='text-danger'>{$product['price']} руб</p>";
        echo "<div class='d-flex w-100 justify-content-between align-items-center'>
        <button onclick='remove_product({$product['id_product']})' class='btn btn-primary'>-</button>
        <p class='card-text m-0'>{$product['count']}</p>
        <button onclick='add_product({$product['id_product']}, 1)' class='btn btn-primary'>+</button>
        </div>";
        echo "</div>
</div>";
    }
    echo "</div>";
    ?>
    <?php
    if ($products) {
        echo '<button type="button" class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Сформировать заказ</button>';
    } else {
        echo "<p class='mt-3'>В корзине ничего нет</p>";
    }
    ?>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Подтвердите пароль </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3 needs-validation" novalidate onsubmit="onSubmit()">
                        <label for="exampleInputPassword1" class="form-label">Пароль</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                        <div class="invalid-feedback">
                            Введите пароль
                        </div>
                        <button class="btn btn-primary" type="submit">Отправить</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button onclick='order()' type="button" class="btn btn-success">Сформировать заказ</button>
                </div>
            </div>
        </div>
    </div>
</div>

