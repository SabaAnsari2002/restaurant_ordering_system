<?php
use yii\helpers\Html;

$this->title = 'Your Selection Summary';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container my-5">
    <h1 class="text-center mb-4">Your Pizza Selection</h1>

    <div class="my-4">
        <h3>Bread Types</h3>
        <ul>
            <?php foreach ($breadData as $bread): ?>
                <li><?= Html::encode($bread['name']) ?> - $<?= number_format($bread['price'], 2) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="my-4">
        <h3>Sausage Types</h3>
        <ul>
            <?php foreach ($sausageData as $sausage): ?>
                <li><?= Html::encode($sausage['name']) ?> - $<?= number_format($sausage['price'], 2) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="my-4">
        <h3>Toppings</h3>
        <ul>
            <?php foreach ($toppingData as $topping): ?>
                <li><?= Html::encode($topping['name']) ?> - $<?= number_format($topping['price'], 2) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="text-center mt-4">
        <h2>Total Price: $<?= number_format($totalPrice, 2) ?></h2>
    </div>

    <div class="text-center mt-4">
        <?= Html::a('Place Order', ['order/confirm'], ['class' => 'btn btn-success btn-lg']) ?>
    </div>
</div>
