<?php
use yii\helpers\Html;

$this->title = 'Restaurants in ' . Html::encode($category);
?>
<div class="text-center my-4">
    <!-- Link to view-cart action in cart controller -->
    <?= Html::a('Go Shopping', ['cart/view-cart'], ['class' => 'btn btn-primary btn-lg']) ?>
</div>
<div class="container my-5">
    <div class="text-center mb-4">
        <h1 class="display-5">Restaurants Offering <span class="text-primary"><?= Html::encode($category) ?></span></h1>
        <p class="text-muted">Discover the best places offering delicious <?= Html::encode($category) ?> dishes.</p>
    </div>

    <div class="row">
        <?php if (count($restaurants) > 0): ?>
            <?php foreach ($restaurants as $restaurant): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?= Html::encode($restaurant->name) ?></h5>
                            <p class="card-text">
                                <i class="bi bi-geo-alt-fill"></i> <?= Html::encode($restaurant->address) ?>
                            </p>
                        </div>
                        <div class="card-footer">
                            <?= Html::a('View Details', ['menu/restaurant', 'id' => $restaurant->id], ['class' => 'btn btn-primary btn-block']) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p class="alert alert-warning">No restaurants found in this category.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
