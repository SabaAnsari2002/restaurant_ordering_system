<?php
use yii\helpers\Html;

$this->title = 'Menu Item: ' . Html::encode($menu->name);
?>

<div class="container my-5">
    <h1 class="text-center"><?= Html::encode($menu->name) ?></h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= Html::encode($menu->name) ?></h5>
            <p class="card-text"><?= Html::encode($menu->description) ?></p>
            <p class="text-primary font-weight-bold"><?= Yii::$app->formatter->asCurrency($menu->price) ?></p>
        </div>
    </div>
</div>
