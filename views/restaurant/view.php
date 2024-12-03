<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $restaurant app\models\Restaurant */
/* @var $menus app\models\Menu[] */

$this->title = $restaurant->name;
?>

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <p><strong>Contact:</strong> <?= Html::encode($restaurant->contact_number) ?></p>
                <p><strong>Address:</strong> <?= Html::encode($restaurant->address) ?></p>
            </div>

            <div class="mb-4">
            <?= Html::a('Create Pizza Order', ['pizza-order/create', 'restaurant_id' => $restaurant->id], ['class' => 'btn btn-primary']) ?>

                <?= Html::a('Edit Restaurant', ['update', 'id' => $restaurant->id], ['class' => 'btn btn-warning me-2']) ?>
                <?= Html::a('Delete Restaurant', ['delete', 'id' => $restaurant->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this restaurant?',
                        'method' => 'post',
                        'params' => ['redirect' => 'false'],
                    ],
                ]) ?>
            </div>

            <h3 class="mt-4">Menu:</h3>
            <?php
            $groupedMenus = [];
            foreach ($menus as $menu) {
                $groupedMenus[$menu->category][] = $menu;
            }
            ?>

            <?php foreach ($groupedMenus as $category => $menuItems): ?>
                <div class="mb-3">
                    <h4 class="text-secondary"><?= Html::encode($category) ?></h4>
                    <ul class="list-group">
                        <?php foreach ($menuItems as $menu): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><?= Html::encode($menu->name) ?> -
                                    <strong>$<?= number_format($menu->price, 2) ?></strong></span>
                                <div>
                                    <?= Html::a('Edit', ['restaurant/edit-menu', 'id' => $restaurant->id, 'menu_id' => $menu->id], ['class' => 'btn btn-warning btn-sm me-2']) ?>
                                    <?= Html::a('Delete', ['restaurant/delete-menu', 'id' => $menu->id], [
                                        'class' => 'btn btn-danger btn-sm',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to delete this menu item?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>

            <div class="mt-4">
                <?= Html::a('View Orders', ['restaurant/view-orders', 'id' => $restaurant->id], ['class' => 'btn btn-primary me-2']) ?>
                <?= Html::a('Add Menu Item', ['restaurant/add-menu', 'id' => $restaurant->id], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
</div>