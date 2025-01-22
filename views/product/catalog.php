<?php

use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Каталог товаров';
?>
<div class="product-index">

  <h1><?= Html::encode($this->title) ?></h1>

  <?php // echo $this->render('_search', ['model' => $searchModel]); 
  ?>
  <div class="input-group mb-3 d-flex flex-row gap-2">
    <div class="input-group mb-3" style="width:max-content;">
      <div class='d-flex align-items-center'>
        <a class="btn btn-outline-secondary flex" href="https://exam-kravetc.xn--80ahdri7a.site/product/catalog?sort=price" type="button" id="button-addon1">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1" />
          </svg></a>
        <div class="input-group-text px-4">По цене</div>
        <a class="btn btn-outline-secondary" href="https://exam-kravetc.xn--80ahdri7a.site/product/catalog?sort=-price" type="button" id="button-addon2">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5" />
          </svg></a>
      </div>
    </div>
    <div class="input-group mb-3" style="width:max-content;">
      <div class='d-flex align-items-center'>
        <a class="btn btn-outline-secondary flex"  href="https://exam-kravetc.xn--80ahdri7a.site/product/catalog?sort=created" type="button" id="button-addon1">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1" />
          </svg></a>
        <div class="input-group-text px-4">По новизне</div>
        <a class="btn btn-outline-secondary" href="https://exam-kravetc.xn--80ahdri7a.site/product/catalog?sort=-created" type="button" id="button-addon2">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5" />
          </svg></a>
      </div>
    </div>
    <div class="input-group mb-3" style="width:max-content;">
      <div class='d-flex align-items-center'>
        <a class="btn btn-outline-secondary flex" href="https://exam-kravetc.xn--80ahdri7a.site/product/catalog?sort=country" type="button" id="button-addon1">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1" />
          </svg></a>
        <div class="input-group-text px-4">По стране происхождения</div>
        <a class="btn btn-outline-secondary" href="https://exam-kravetc.xn--80ahdri7a.site/product/catalog?sort=-country" type="button" id="button-addon2">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5" />
          </svg></a>
      </div>
    </div>
    <div class="input-group mb-3" style="width:max-content;">
      <div class='d-flex align-items-center'>
        <a class="btn btn-outline-secondary flex" href="https://exam-kravetc.xn--80ahdri7a.site/product/catalog?sort=name" type="button" id="button-addon1">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1" />
          </svg></a>
        <div class="input-group-text px-4">По наименованию</div>
        <a class="btn btn-outline-secondary" href="https://exam-kravetc.xn--80ahdri7a.site/product/catalog?sort=-name" type="button" id="button-addon2">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5" />
          </svg></a>
      </div>
    </div>
  </div>
</div>
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
                console.log(result)
                let title = document.getElementById('staticBackdropLabel');
                let body = document.getElementById('modalBody');
                if (result == 'false') {
                    title.innerText = 'Ошибка';
                    body.innerHTML = "<p>Ошибка добавления товара, вероятно, товар уже раскупили</p>"
                } else {
                    title.innerText = 'Информационное сообщение';
                    body.innerHTML = "<p>Товар успешно добавлен в корзину</p>"
                }
                let myModal = new bootstrap.Modal(document.getElementById("staticBackdrop"), {});
                myModal.show();
            })
    }
</script>
<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$products = $dataProvider->getModels();
echo "<div class='d-flex flex-row flex-wrap justify-content-start border border-1 border-info align-itemsend'>";
foreach ($products as $product) {
  if ($product->count > 0) {
    echo "<div class='card m-1' style='width: 22%; min-width: 300px;'>
 <a href='/product/view?id={$product->id_product}'><img src='http://exam-kravetc.xn--80ahdri7a.site/{$product->photo}' class='card-img-top'
style='max-height: 300px;' alt='image'></a>
 <div class='card-body'>
 <h5 class='card-title'>{$product->name}</h5>
 <p class='text-danger'>{$product->price} руб</p>";
    echo (Yii::$app->user->isGuest ? "<a href='/product/view?id_product={$product->id_product}' class='btn btn-primary'>Просмотр товара</a>" : "<p onclick='add_product({$product->id_product}, 1)' class='btn btn-primary'>Добавить в корзину</p>");
    echo "</div>
</div>";
  }
}
echo "</div>";
