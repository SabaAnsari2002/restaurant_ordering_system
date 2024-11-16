<?php
use yii\helpers\Html;
use yii\helpers\Url;
use Yii;

$this->title = 'View Cart';
?>

<div class="container my-5">
    <?php if ($lastOrderRestaurant): ?>
        <div class="alert alert-info">
            Your food order from <?= Html::encode($lastOrderRestaurant) ?> is being prepared.
        </div>
    <?php endif; ?>

    <?php foreach ($groupedItems as $restaurantName => $items): ?>
        <h3><?= Html::encode($restaurantName) ?></h3>
        <div class="card mb-3">
            <div class="card-body">
                <?php foreach ($items as $item): ?>
                    <div class="mb-2">
                        <strong><?= Html::encode($item->menu->name) ?></strong>
                        <span class="float-right">
                            <?= Html::a('-', ['cart/update-quantity', 'cartId' => $item->id, 'change' => -1], ['class' => 'btn btn-sm btn-outline-primary']) ?>
                            <?= Html::encode($item->quantity) ?>
                            <?= Html::a('+', ['cart/update-quantity', 'cartId' => $item->id, 'change' => 1], ['class' => 'btn btn-sm btn-outline-primary']) ?>
                            Price: <?= Yii::$app->formatter->asCurrency($item->menu->price * $item->quantity) ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="card-footer">
                <strong>Total: <?= Yii::$app->formatter->asCurrency($totalPrices[$restaurantName]) ?></strong>
                <?= Html::a('Place Order', ['cart/place-order', 'restaurantId' => $items[0]->restaurant_id], ['class' => 'btn btn-primary float-right']) ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>