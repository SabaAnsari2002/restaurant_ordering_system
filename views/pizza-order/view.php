<?php
/* @var $this yii\web\View */
/* @var $pizzaOrder app\models\PizzaOrder */

use yii\helpers\Html;

$this->title = 'Order Details';
?>
<div class="pizza-order-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><strong>Bread Types:</strong> <?= implode(', ', $pizzaOrder->bread_types) ?></p>
    <p><strong>Sausage Types:</strong> <?= implode(', ', $pizzaOrder->sausage_types) ?></p>
    <p><strong>Toppings:</strong> <?= implode(', ', $pizzaOrder->toppings) ?></p>

    <?= Html::a('Back to Order Form', ['create', 'restaurant_id' => $pizzaOrder->restaurant_id], ['class' => 'btn btn-primary']) ?>
</div>
