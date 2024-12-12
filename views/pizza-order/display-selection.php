<?php
use yii\helpers\Html;

$this->title = 'Your Selected Pizza Options';
$this->params['breadcrumbs'][] = ['label' => 'Menu', 'url' => ['menu/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container my-5">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <div class="my-4">
        <h3>Bread Types</h3>
        <?php if (!empty($selectedBreadTypes)): ?>
            <ul>
                <?php foreach ($selectedBreadTypes as $bread): ?>
                    <li><?= Html::encode($bread) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No bread types selected.</p>
        <?php endif; ?>
    </div>

    <div class="my-4">
        <h3>Sausage Types</h3>
        <?php if (!empty($selectedSausageTypes)): ?>
            <ul>
                <?php foreach ($selectedSausageTypes as $sausage): ?>
                    <li><?= Html::encode($sausage) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No sausage types selected.</p>
        <?php endif; ?>
    </div>

    <div class="my-4">
        <h3>Toppings</h3>
        <?php if (!empty($selectedToppings)): ?>
            <ul>
                <?php foreach ($selectedToppings as $topping): ?>
                    <li><?= Html::encode($topping) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No toppings selected.</p>
        <?php endif; ?>
    </div>
</div>
