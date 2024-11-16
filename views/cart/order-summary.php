<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Order Summary';
?>

<div class="container my-5">
    <h2><?= Html::encode($this->title) ?></h2>

    <h3><?= Html::encode($restaurant->name) ?></h3>

    <div class="card mb-3">
        <div class="card-body">
            <?php foreach ($cartItems as $item): ?>
                <div class="mb-2">
                    <strong><?= Html::encode($item->menu->name) ?></strong>
                    <span class="float-right">
                        Quantity: <?= Html::encode($item->quantity) ?>
                        Price: <?= Yii::$app->formatter->asCurrency($item->quantity * $item->menu->price) ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="card-footer">
            <strong>Total: <?= Yii::$app->formatter->asCurrency($totalPrice) ?></strong>
        </div>
    </div>

    <h4>Order Details:</h4>
    <p>Name: <?= Html::encode($pendingOrder['customer_name']) ?></p>
    <p>Contact: <?= Html::encode($pendingOrder['phone_number']) ?></p>
    <p>Address: <?= Html::encode($pendingOrder['address']) ?></p>

    <?= Html::a('Confirm Order', ['confirm-order'], ['class' => 'btn btn-success']) ?>
</div>