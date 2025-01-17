<?php
use yii\helpers\Html;

$this->title = Html::encode($menu->name);
$this->params['breadcrumbs'][] = ['label' => 'Menu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="menu-view">
    <h1 class="text-primary"><?= Html::encode($menu->name) ?></h1>
    <p><strong>Description:</strong> <?= Html::encode($menu->description) ?></p>
    <p><strong>Price:</strong> <?= Yii::$app->formatter->asCurrency($menu->price) ?></p>
    <p><strong>Category:</strong> <?= Html::encode($menu->category) ?></p>
    <p><strong>Stock:</strong> <?= Html::encode($menu->stock) ?></p>
    <div class="my-3">
        <?= Html::a('Add to Cart', ['cart/add-to-cart', 'menuId' => $menu->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Back to Menu', ['restaurant', 'id' => $menu->restaurant_id], ['class' => 'btn btn-secondary']) ?>
    </div>
</div>
