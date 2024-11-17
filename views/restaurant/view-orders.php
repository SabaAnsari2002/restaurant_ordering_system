<?php foreach ($orders as $order): ?>
    <div class="order">
        <div class="order-header">
            <h4>Order ID: <?= $order->id ?> - Status: <span class="status"><?= $order->status ?></span></h4>
            <p><strong>Customer Name:</strong> <?= $order->customer_name ?></p>
        </div>
        <div class="order-items">
            <h5>Order Items:</h5>
            <ul>
                <?php
                // نمایش آیتم‌های سفارش
                $orderItems = $order->orderItems; // رابطه با مدل OrderItem
                foreach ($orderItems as $item):
                ?>
                    <li>
                        <strong><?= $item->quantity ?> x <?= $item->menu->name ?></strong>
                        <span class="item-price"><?= $item->menu->price ?> </span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php endforeach; ?>


<style>
    /* استایل‌دهی برای هر سفارش */
.order {
    border: 1px solid #ddd;
    border-radius: 8px;
    margin: 10px 0;
    padding: 15px;
    background-color: #f9f9f9;
}

/* استایل برای هدر هر سفارش */
.order-header {
    margin-bottom: 10px;
}

/* استایل برای وضعیت سفارش */
.status {
    font-weight: bold;
    color: #4CAF50;
}

/* استایل برای آیتم‌های سفارش */
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

.order-items ul li strong {
    font-size: 1.1em;
}

.item-price {
    font-size: 0.9em;
    color: #333;
    margin-left: 10px;
    font-weight: bold;
}

</style>