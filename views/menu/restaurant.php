<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Html::encode($restaurant->name);
$this->params['breadcrumbs'][] = ['label' => 'Restaurants', 'url' => ['menu/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-restaurant-details">
    <!-- Shopping Button -->
    <div class="text-center my-4">
        <?= Html::a('Go Shopping', ['cart/view-cart'], ['class' => 'btn btn-primary btn-lg']) ?>
    </div>

    <div class="container my-5">
        <!-- Restaurant Header -->
        <div class="text-center mb-5">
            <h1 class="display-4 text-primary"><?= Html::encode($restaurant->name) ?></h1>
            <p class="text-muted"><?= Html::encode($restaurant->tagline ?? 'Discover delicious meals!') ?></p>
        </div>

        <!-- Restaurant Details Card -->
        <div class="card mb-5 shadow-sm">
            <div class="card-body">
                <h5 class="card-title text-secondary">Restaurant Details</h5>
                <p><strong>Address:</strong> <?= Html::encode($restaurant->address) ?></p>
                <p><strong>Contact:</strong> <?= Html::encode($restaurant->contact_number) ?></p>
            </div>
        </div>
        <?php if ($hasPizzaOrder): ?>
    <div class="text-center my-4">
    <?= Html::a('Go to Menu', ['pizza-order/view-menu', 'restaurant_id' => $restaurant->id], ['class' => 'btn btn-primary']) ?>

        
    </div>
<?php endif; ?>

        <!-- Menu Section -->
        <h2 class="text-primary mb-4">Menu</h2>

        <?php foreach ($menusByCategory as $category => $categoryMenus): ?>
            <h3 class="text-secondary"><?= Html::encode($category) ?></h3>
            <div class="row">
                <?php foreach ($categoryMenus as $menu): ?>
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-truncate"><?= Html::encode($menu['name']) ?></h5>
                                <p class="card-text text-muted"><?= Html::encode($menu['description']) ?></p>
                                <p class="text-primary font-weight-bold">
                                    <?= Yii::$app->formatter->asCurrency($menu['price']) ?>
                                </p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <?php if ($menu['stock'] > 0): ?>
                                    <?= Html::a('Add to Cart', ['cart/add-to-cart', 'menuId' => $menu['id']], [
                                        'class' => 'btn btn-success flex-grow-1 me-2'
                                    ]) ?>
                                <?php else: ?>
                                    <button class="btn btn-secondary flex-grow-1 me-2" disabled>Out of Stock</button>
                                <?php endif; ?>
                                <?= Html::a('View Details', ['menu/view-menu', 'id' => $menu['id']], [
                                    'class' => 'btn btn-primary flex-grow-1'
                                ]) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
