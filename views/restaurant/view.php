<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $restaurant app\models\Restaurant */
/* @var $menus app\models\Menu[] */

$this->title = $restaurant->name;
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>Contact: <?= $restaurant->contact_number ?></p>
<p>Address: <?= $restaurant->address ?></p>

<?= Html::a('Edit Restaurant', ['update', 'id' => $restaurant->id], ['class' => 'btn btn-warning']) ?>
<?= Html::a('Delete Restaurant', ['delete', 'id' => $restaurant->id], [
    'class' => 'btn btn-danger',
    'data' => [
        'confirm' => 'Are you sure you want to delete this restaurant?',
        'method' => 'post',
        'params' => ['redirect' => 'false'],
    ],
]) ?>

<h3>Menu:</h3>

<?php
$groupedMenus = [];
foreach ($menus as $menu) {
    $groupedMenus[$menu->category][] = $menu;
}
?>

<?php foreach ($groupedMenus as $category => $menuItems): ?>
    <h4><?= Html::encode($category) ?></h4>
    <ul>
        <?php foreach ($menuItems as $menu): ?>
            <li>
                <?= Html::encode($menu->name) ?> - $<?= $menu->price ?>
                <?= Html::a('Edit', ['restaurant/edit-menu', 'id' => $restaurant->id, 'menu_id' => $menu->id], ['class' => 'btn btn-warning btn-sm']) ?>
                <?= Html::a('Delete', ['restaurant/delete-menu', 'id' => $menu->id], [
                    'class' => 'btn btn-danger btn-sm',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this menu item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endforeach; ?>

<?= Html::a('Add Menu Item', ['restaurant/add-menu', 'id' => $restaurant->id], ['class' => 'btn btn-primary']) ?>