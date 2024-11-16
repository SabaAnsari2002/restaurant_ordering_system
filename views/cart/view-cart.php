<?php
use yii\helpers\Html;
use yii\helpers\Url;
use Yii; // وارد کردن کلاس Yii برای استفاده از Formatter

$this->title = 'View Cart';
?>
<div class="container my-5">
    <?php foreach ($groupedItems as $restaurantName => $items): ?>
        <h3><?= Html::encode($restaurantName) ?></h3>
        <?php $totalPrice = 0; ?>
        <?php foreach ($items as $item): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5><?= Html::encode($item->menu->name) ?></h5>
                    <p>Quantity: <?= Html::encode($item->quantity) ?></p>
                    <p>Price: <?= Yii::$app->formatter->asCurrency($item->menu->price * $item->quantity) ?></p>
                    <p>Restaurant: <?= Html::encode($item->restaurant->name) ?></p>
                </div>
                <div class="card-footer">
                    <a href="<?= Url::to(['cart/update-cart', 'cartId' => $item->id, 'quantity' => $item->quantity - 1]) ?>" class="btn btn-danger btn-sm">-</a>
                    <a href="<?= Url::to(['cart/update-cart', 'cartId' => $item->id, 'quantity' => $item->quantity + 1]) ?>" class="btn btn-success btn-sm">+</a>
                    <a href="<?= Url::to(['cart/update-cart', 'cartId' => $item->id, 'quantity' => 0]) ?>" class="btn btn-warning btn-sm">Remove</a>
                </div>
            </div>
            <?php $totalPrice += $item->menu->price * $item->quantity; ?>
        <?php endforeach; ?>
        <h5>Total for <?= Html::encode($restaurantName) ?>: <?= Yii::$app->formatter->asCurrency($totalPrice) ?></h5>
    <?php endforeach; ?>
</div>

