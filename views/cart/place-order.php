<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Place Order';
?>

<div class="container my-5">
    <h2><?= Html::encode($this->title) ?></h2>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($order, 'customer_name')->textInput(['value' => Yii::$app->user->identity->username, 'readonly' => true]) ?>
    <?= $form->field($order, 'phone_number')->textInput(['maxlength' => true]) ?>
    <?= $form->field($order, 'address')->textarea(['rows' => 6]) ?>
    <?= $form->field($order, 'restaurant_id')->hiddenInput(['value' => $restaurantId])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Place Order', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>