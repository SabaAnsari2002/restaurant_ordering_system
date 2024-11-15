<?php
use yii\helpers\Html;

$this->title = 'View Menu';
?>

<div class="container my-5">
    <!-- Food Categories Section -->
    <div class="mb-5">
        <h1 class="text-center mb-4">Food Categories</h1>
        <div class="row">
            <?php foreach ($categories as $category): ?>
                <div class="col-md-3 mb-3">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <h5 class="card-title">
                                <?= Html::a(Html::encode($category['category']), ['menu/category', 'category' => $category['category']], ['class' => 'stretched-link']) ?>
                            </h5>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- All Restaurants Section -->
    <div>
        <h1 class="text-center mb-4">All Restaurants</h1>
        <div class="row">
            <?php foreach ($restaurants as $restaurant): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= Html::encode($restaurant->name) ?></h5>
                            <p class="card-text"><?= Html::encode($restaurant->address) ?></p>
                        </div>
                        <div class="card-footer">
                            <?= Html::a('View Details', ['menu/restaurant', 'id' => $restaurant->id], ['class' => 'btn btn-info btn-block']) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
