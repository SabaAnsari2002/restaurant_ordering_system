<?php 
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'View Menu';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-menu">
    <div class="text-center my-5">
        <h1 class="display-4"><?= Html::encode($this->title) ?></h1>
        <p class="lead">Explore delicious food categories and restaurants.</p>
        <?= Html::a('Go Shopping', ['cart/view-cart'], ['class' => 'btn btn-primary btn-lg mt-3']) ?>
    </div>

    <div class="container my-5">
        <!-- Food Categories Section -->
        <div class="mb-5">
            <h2 class="text-center text-success mb-4">Food Categories</h2>
            <div class="row">
                <?php foreach ($categories as $category): ?>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card shadow h-100">
                            <div class="card-body d-flex align-items-center justify-content-center">
                                <h5 class="card-title text-center">
                                    <?= Html::a(Html::encode($category['category']), ['menu/category', 'category' => $category['category']], ['class' => 'stretched-link text-decoration-none text-dark']) ?>
                                </h5>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- All Restaurants Section -->
        <div>
            <h2 class="text-center text-info mb-4">All Restaurants</h2>
            <div class="row">
                <?php foreach ($restaurants as $restaurant): ?>
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card shadow h-100">
                            <div class="card-body">
                                <h5 class="card-title"><?= Html::encode($restaurant->name) ?></h5>
                                <p class="card-text">
                                    <i class="fas fa-map-marker-alt"></i> <?= Html::encode($restaurant->address) ?>
                                </p>
                            </div>
                            <div class="card-footer text-center">
                                <?= Html::a('View Details', ['menu/restaurant', 'id' => $restaurant->id], ['class' => 'btn btn-info btn-block']) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
