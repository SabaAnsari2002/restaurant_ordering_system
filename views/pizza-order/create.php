<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PizzaOrder */
/* @var $restaurant app\models\Restaurant */

$this->title = 'Create Pizza Order for ' . Html::encode($restaurant->name);
?>

<div class="pizza-order-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'restaurant_id')->hiddenInput()->label(false) ?>

    <div class="mb-3">
        <?= $form->field($model, 'bread_types')->checkboxList([
            'Thin' => 'Thin',
            'Thick' => 'Thick',
            'Stuffed' => 'Stuffed',
        ])->label('Bread Types (Select multiple)') ?>
    </div>

    <div class="mb-3">
        <?= $form->field($model, 'sausage_types')->checkboxList([
            'Beef' => 'Beef',
            'Chicken' => 'Chicken',
            'Pork' => 'Pork',
        ])->label('Sausage Types (Select multiple)') ?>
    </div>

    <div class="mb-3">
        <?= $form->field($model, 'toppings')->checkboxList([
            'Cheese' => 'Cheese',
            'Mushrooms' => 'Mushrooms',
            'Olives' => 'Olives',
            'Peppers' => 'Peppers',
        ])->label('Toppings (Select multiple)') ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Place Order', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
