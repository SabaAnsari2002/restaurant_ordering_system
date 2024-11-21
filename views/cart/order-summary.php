<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Order Summary';
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm rounded">
                <div class="card-header bg-info text-white text-center">
                    <h2 class="mb-0"><?= Html::encode($this->title) ?></h2>
                </div>
                <div class="card-body">
                    <h4 class="mb-4 text-primary"><?= Html::encode($restaurant->name) ?></h4>

                    <div class="list-group mb-4">
                        <?php foreach ($cartItems as $item): ?>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong><?= Html::encode($item->menu->name) ?></strong>
                                </div>
                                <div class="text-right">
                                    <div>Quantity: <strong><?= Html::encode($item->quantity) ?></strong></div>
                                    <div>Price: <strong><?= Yii::$app->formatter->asCurrency($item->quantity * $item->menu->price) ?></strong></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="text-right">
                        <h5><strong>Total: <?= Yii::$app->formatter->asCurrency($totalPrice) ?></strong></h5>
                    </div>

                    <div class="mt-4">
                        <h5 class="text-primary">Order Details:</h5>
                        <p><strong>Name:</strong> <?= Html::encode($pendingOrder['customer_name']) ?></p>
                        <p><strong>Contact:</strong> <?= Html::encode($pendingOrder['phone_number']) ?></p>
                        <p><strong>Address:</strong> <?= Html::encode($pendingOrder['address']) ?></p>
                    </div>

                    <div class="text-center mt-4">
                        <?= Html::a('Confirm Order', ['confirm-order'], ['class' => 'btn btn-success btn-lg px-5']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
    .card {
        border-radius: 10px;
        border: none;
    }

    .card-header {
        border-bottom: 2px solid #fff;
        font-size: 1.5rem;
    }

    .list-group-item {
        border: none;
        padding: 1rem 1.5rem;
        background-color: #f8f9fa;
        border-radius: 5px;
        margin-bottom: 0.5rem;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-success:hover {
        background-color: #218838;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.4);
    }

    .text-primary {
        color: #007bff !important;
    }
</style>
