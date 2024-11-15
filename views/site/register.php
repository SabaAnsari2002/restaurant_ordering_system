<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Register';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'username') ?>
<?= $form->field($model, 'email') ?>
<?= $form->field($model, 'password')->passwordInput() ?>
<?= $form->field($model, 'confirmPassword')->passwordInput() ?>
<?= $form->field($model, 'role')->dropDownList(['customer' => 'Customer', 'restaurant' => 'Restaurant Administrator'], ['prompt' => 'Select Role']) ?>
<div class="form-group">
    <?= Html::submitButton('Register', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
