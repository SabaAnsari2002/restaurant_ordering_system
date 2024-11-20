<?php
use yii\helpers\Html;

$this->title = 'Restaurants in ' . Html::encode($category);
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-category-restaurants">
    <!-- Shopping Button -->
    <div class="text-center my-5">
        <?= Html::a('Go Shopping', ['cart/view-cart'], ['class' => 'btn btn-primary btn-lg']) ?>
    </div>

    <!-- Header Section -->
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-5">Restaurants Offering <span class="text-primary"><?= Html::encode($category) ?></span></h1>
            <p class="text-muted">Discover the best places offering delicious <?= Html::encode($category) ?> dishes.</p>
        </div>

        <!-- Restaurant List -->
        <div class="row">
            <?php if (!empty($restaurants)): ?>
                <?php foreach ($restaurants as $restaurant): ?>
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card h-100 shadow">
                            <div class="card-body">
                                <h5 class="card-title text-truncate"><?= Html::encode($restaurant->name) ?></h5>
                                <p class="card-text text-muted">
                                    <i class="bi bi-geo-alt-fill"></i> <?= Html::encode($restaurant->address) ?>
                                </p>
                            </div>
                            <div class="card-footer text-center">
                                <?= Html::a('View Details', ['menu/restaurant', 'id' => $restaurant->id], ['class' => 'btn btn-primary btn-block']) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <div class="alert alert-warning">No restaurants found in this category.</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
