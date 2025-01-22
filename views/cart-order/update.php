<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CartOrder $model */

$this->title = 'Update Cart Order: ' . $model->order_id;
$this->params['breadcrumbs'][] = ['label' => 'Cart Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->order_id, 'url' => ['view', 'order_id' => $model->order_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cart-order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
