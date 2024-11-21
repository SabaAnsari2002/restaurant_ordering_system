<?php
use yii\helpers\Html;
use yii\helpers\Url;
use Yii;

$this->title = 'View Cart';
?>

<div class="container my-5">
    <?php if ($lastOrderRestaurant): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Your food order from <?= Html::encode($lastOrderRestaurant) ?> is being prepared.</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php foreach ($groupedItems as $restaurantName => $items): ?>
        <div class="restaurant-section mb-4">
            <h3 class="restaurant-title"><?= Html::encode($restaurantName) ?></h3>
            <div class="card shadow-sm rounded">
                <div class="card-body">
                    <?php foreach ($items as $item): ?>
                        <div class="cart-item mb-3 d-flex justify-content-between align-items-center">
                            <div>
                                <strong><?= Html::encode($item->menu->name) ?></strong>
                            </div>
                            <div class="d-flex align-items-center">
                                <?= Html::a('-', ['cart/update-quantity', 'cartId' => $item->id, 'change' => -1], ['class' => 'btn btn-sm btn-outline-primary mx-1']) ?>
                                <span class="quantity"><?= Html::encode($item->quantity) ?></span>
                                <?= Html::a('+', ['cart/update-quantity', 'cartId' => $item->id, 'change' => 1], ['class' => 'btn btn-sm btn-outline-primary mx-1']) ?>
                            </div>
                            <div class="price">
                                Price: <?= Yii::$app->formatter->asCurrency($item->menu->price * $item->quantity) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <strong>Total: <?= Yii::$app->formatter->asCurrency($totalPrices[$restaurantName]) ?></strong>
                    <?= Html::a('Place Order', ['cart/place-order', 'restaurantId' => $items[0]->restaurant_id], ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Custom CSS for a more modern look -->
<style>
    .restaurant-section {
        border-bottom: 2px solid #f1f1f1;
        padding-bottom: 20px;
    }
    
    .restaurant-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 10px;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .cart-item {
        padding: 10px;
        border-bottom: 1px solid #e9ecef;
        font-size: 1rem;
    }

    .quantity {
        margin: 0 10px;
        font-weight: 600;
    }

    .price {
        font-size: 1rem;
        color: #28a745;
        font-weight: 500;
    }

    .btn-outline-primary {
        border-radius: 50%;
        padding: 5px 10px;
        font-size: 16px;
    }

    .btn-success {
        background-color: #28a745;
        color: white;
    }

    .alert {
        margin-bottom: 20px;
    }

    .card-footer {
        font-weight: bold;
        background-color: #f8f9fa;
    }

    .card-footer .btn-success {
        background-color: #007bff;
        border: none;
    }
</style>
