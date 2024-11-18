<?php
use yii\helpers\Html;
use yii\helpers\Url;
use Yii;

$this->title = 'View Orders';
?>

<div class="container my-5">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!empty($orders)): ?>
        <?php foreach ($orders as $order): ?>
            <div class="order mb-4">
                <div class="order-header">
                    <h4>Order ID: <?= $order->id ?> - Status: 
                        <span class="status"><?= Html::encode($order->status) ?></span>
                    </h4>
                    <p><strong>Customer Name:</strong> <?= Html::encode($order->customer_name) ?></p>
                    <p><strong>Address:</strong> <?= Html::encode($order->address) ?></p>
                    <p><strong>Phone:</strong> <?= Html::encode($order->phone_number) ?></p>
                </div>

                <div class="order-items">
                    <h5>Order Items:</h5>
                    <ul>
                        <?php
                        // Display order items
                        $orderItems = $order->orderItems; // Relationship with OrderItem model
                        foreach ($orderItems as $item): ?>
                            <li>
                                <strong><?= Html::encode($item->quantity) ?> x <?= Html::encode($item->menu->name) ?></strong>
                                <span class="item-price"><?= Yii::$app->formatter->asCurrency($item->menu->price * $item->quantity) ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="order-actions">
                    <?php if ($order->status === 'pending'): ?>
                        <!-- Restaurant admin can change status to 'sent' -->
                        <?= Html::a('Mark as Sent', ['order/update-status', 'orderId' => $order->id, 'status' => 'sent'], [
                            'class' => 'btn btn-success',
                            'data' => [
                                'confirm' => 'Are you sure you want to mark this order as sent?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    <?php elseif ($order->status === 'sent'): ?>
                        <span class="badge badge-success">Order Sent</span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-info">No orders found.</div>
    <?php endif; ?>
</div>

<style>
    /* Styling for the order details */
    .order {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        background-color: #f9f9f9;
    }

    .order-header {
        margin-bottom: 10px;
    }

    .status {
        font-weight: bold;
        color: #4CAF50;
    }

    .order-items h5 {
        margin-top: 10px;
        font-size: 1.1em;
    }

    .order-items ul {
        list-style-type: none;
        padding: 0;
    }

    .order-items ul li {
        padding: 8px;
        background-color: #f0f0f0;
        margin-bottom: 5px;
        border-radius: 5px;
    }

    .item-price {
        font-size: 0.9em;
        color: #333;
        margin-left: 10px;
        font-weight: bold;
    }

    .order-actions {
        margin-top: 15px;
    }
</style>
