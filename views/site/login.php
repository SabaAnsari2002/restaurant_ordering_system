<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3><?= Html::encode($this->title) ?></h3>
                    <p>Please fill out the following fields to login:</p>
                </div>
                <div class="card-body">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'username', [
                        'inputOptions' => ['class' => 'form-control', 'placeholder' => 'Enter your username'],
                    ])->label(false) ?>

                    <?= $form->field($model, 'password', [
                        'inputOptions' => ['class' => 'form-control', 'placeholder' => 'Enter your password'],
                    ])->passwordInput()->label(false) ?>

                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'template' => "<div class=\"form-check\">{input} {label}</div>\n{error}",
                    ]) ?>

                    <div class="form-group text-center">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-lg w-100']) ?>
                    </div>

                    <div class="text-center mt-3">
                        <p>Don't have an account? <?= Html::a('Register here', ['register'], ['class' => 'text-decoration-underline']) ?></p>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
