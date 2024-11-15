<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $restaurant->name;
?>

<div class="container my-5">
    <div class="text-center mb-4">
        <h1 class="display-4"><?= Html::encode($restaurant->name) ?></h1>
        <p class="text-muted"><?= Html::encode($restaurant->tagline ?? 'Discover delicious meals!') ?></p>
    </div>

    <div class="card mb-5">
        <div class="card-body">
            <h5 class="card-title">Restaurant Details</h5>
            <p><strong>Address:</strong> <?= Html::encode($restaurant->address) ?></p>
            <p><strong>Contact:</strong> <?= Html::encode($restaurant->contact_number) ?></p>
        </div>
    </div>

    <h2 class="mb-4">Menu</h2>

    <?php foreach ($menusByCategory as $category => $categoryMenus): ?>
        <h3><?= Html::encode($category) ?></h3>
        <div class="row">
            <?php foreach ($categoryMenus as $menu): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= Html::encode($menu['name']) ?></h5>
                            <p class="card-text"><?= Html::encode($menu['description']) ?></p>
                            <p class="text-primary font-weight-bold">
                                <?= Yii::$app->formatter->asCurrency($menu['price']) ?>
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="<?= Url::to(['menu/view-menu', 'id' => $menu['id']]) ?>" class="btn btn-primary btn-block">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>
