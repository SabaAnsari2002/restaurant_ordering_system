<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $menu app\models\Menu */
/* @var $categories array */

$this->title = 'Edit Menu Item: ' . $menu->name;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="menu-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($menu, 'name')->textInput() ?>
    <?= $form->field($menu, 'description')->textarea() ?>
    <?= $form->field($menu, 'price')->textInput() ?>
    <?= $form->field($menu, 'stock')->textInput(['type' => 'number', 'min' => 1]) ?>

    <label>Category</label>
    <select name="Menu[category]" class="form-control">
        <?php foreach ($categories as $category): ?>
            <option value="<?= $category ?>" <?= $menu->category == $category ? 'selected' : '' ?>><?= $category ?></option>
        <?php endforeach; ?>
    </select>

    <?= $form->field($menu, 'photo')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
