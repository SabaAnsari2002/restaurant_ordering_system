<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Add Menu Item';
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="menu-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($menu, 'name')->textInput() ?>
    <?= $form->field($menu, 'description')->textarea() ?>
    <?= $form->field($menu, 'price')->textInput(['type' => 'number']) ?>
    <?= $form->field($menu, 'stock')->textInput(['type' => 'number', 'min' => 1]) ?>

    <label>Category</label>
    <select name="Menu[category]" class="form-control">
        <?php foreach ($categories as $category): ?>
            <option value="<?= $category ?>"><?= $category ?></option>
        <?php endforeach; ?>
    </select>

    <?= $form->field($menu, 'photo')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
