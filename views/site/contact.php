<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Где нас найти?';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= Html::img('@web/assets/images/map.jpg')?>
    

        <div class="alert alert-success mt-5">
            Мы находимся по адресу Плесецкая 17, вход с торца, ориентир - баннер "Цветы"
        </div>
        <p>8-999-999-99-99</p>
        <p>admin@admin.ru</p>
        </div>