<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Login';
?>

<h1>Login</h1>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'username') ?>
<?= $form->field($model, 'password')->passwordInput() ?>
<?= $form->field($model, 'rememberMe')->checkbox() ?>
<div class="form-group">
    <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
</div>
<p>Don't have an account? <?= Html::a('Register', ['register']) ?></p>
<?php ActiveForm::end(); ?>
