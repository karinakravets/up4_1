<?php

/** @var yii\web\View $this */
/** @var app\models\Product $model */
/** @var yii\data\ActiveDataProvider $dataProvider */

use yii\helpers\Html;

$this->title = 'О нас';
?>
<div class="site-about">
  <h1><?= Html::encode($this->title) ?></h1>

  <div id="carouselExampleIndicators" class="carousel carousel-fade" data-bs-ride="carousel">
    <div class="carousel-indicators">

      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
    </div>
    <div class="carousel-inner">
      <?php
      $products = $dataProvider->getModels();
      echo "<div class='carousel-item active' style='height: 75vh; width: 100%; background-position: center; background-repeat: no-repeat; background-size: cover;
      background-image: url(http://exam-kravetc.xn--80ahdri7a.site/{$products[count($products) - 1]->photo});'>
                <div class='carousel-caption d-none d-md-block'>
                    <h5>{$products[count($products) - 1]->name}</h5>
                    <p>{$products[count($products) - 1]->country} {$products[count($products) - 1]->color} {$products[count($products) - 1]->price} руб</p>
                </div>
            </div>";

      for ($i = count($products) - 2; $i > count($products) - 6; $i--) {
        echo "<div class='carousel-item' style='height: 75vh; width: 100%; background-position: center; background-repeat: no-repeat; background-size: cover;
      background-image: url(http://exam-kravetc.xn--80ahdri7a.site/{$products[$i]->photo});'>
                <div class='carousel-caption d-none d-md-block'>
                    <h5>{$products[$i]->name}</h5>
                    <p>{$products[$i]->country} {$products[$i]->color} {$products[$i]->price} руб</p>
                </div>
            </div>";
      }
      ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Предыдущий</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Следующий</span>
    </button>
  </div>
</div>