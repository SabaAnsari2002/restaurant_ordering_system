<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-register">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-success text-white text-center">
                    <h3><?= Html::encode($this->title) ?></h3>
                    <p>Fill in the details below to create an account.</p>
                </div>
                <div class="card-body">
                    <?php $form = ActiveForm::begin(['id' => 'register-form']); ?>

                    <?= $form->field($model, 'username', [
                        'inputOptions' => ['class' => 'form-control', 'placeholder' => 'Enter your username'],
                    ])->label(false) ?>

                    <?= $form->field($model, 'email', [
                        'inputOptions' => ['class' => 'form-control', 'placeholder' => 'Enter your email'],
                    ])->label(false) ?>

                    <?= $form->field($model, 'password', [
                        'inputOptions' => ['class' => 'form-control', 'placeholder' => 'Enter your password'],
                    ])->passwordInput()->label(false) ?>

                    <?= $form->field($model, 'confirmPassword', [
                        'inputOptions' => ['class' => 'form-control', 'placeholder' => 'Confirm your password'],
                    ])->passwordInput()->label(false) ?>

                    <?= $form->field($model, 'role')->dropDownList(
                        ['customer' => 'Customer', 'restaurant' => 'Restaurant Administrator'],
                        ['prompt' => 'Select Role', 'class' => 'form-select']
                    ) ?>

                    <div class="form-group text-center">
                        <?= Html::submitButton('Register', ['class' => 'btn btn-success btn-lg w-100']) ?>
                    </div>

                    <div class="text-center mt-3">
                        <p>Already have an account? <?= Html::a('Login here', ['login'], ['class' => 'text-decoration-underline']) ?></p>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
