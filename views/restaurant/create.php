<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create Restaurant';
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="restaurant-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'contact_number')->textInput() ?>
    <?= $form->field($model, 'address')->textInput() ?>

    <h3>Categories</h3>
    <?php foreach ($categories as $category): ?>
        <label>
            <input type="checkbox" name="categories[]" value="<?= $category ?>"> <?= $category ?>
        </label><br>
    <?php endforeach; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
