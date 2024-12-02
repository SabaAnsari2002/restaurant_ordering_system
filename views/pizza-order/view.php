<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PizzaOrder */

$this->title = 'Order Details';
?>

<div class="pizza-order-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><strong>Bread Types:</strong> <?= implode(', ', $model->bread_types) ?></p>
    <p><strong>Sausage Types:</strong> <?= implode(', ', $model->sausage_types) ?></p>
    <p><strong>Toppings:</strong> <?= implode(', ', $model->toppings) ?></p>

    <?= Html::a('Back to Order Form', ['create'], ['class' => 'btn btn-primary']) ?>
</div>
