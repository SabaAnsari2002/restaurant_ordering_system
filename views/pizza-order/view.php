<?php
/* @var $this yii\web\View */
/* @var $pizzaOrder app\models\PizzaOrder */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Order Details';
?>
<div class="pizza-order-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><strong>Bread Types:</strong> <?= implode(', ', $pizzaOrder->bread_types) ?></p>
    <p><strong>Sausage Types:</strong> <?= implode(', ', $pizzaOrder->sausage_types) ?></p>
    <p><strong>Toppings:</strong> <?= implode(', ', $pizzaOrder->toppings) ?></p>

    <h3>Enter Prices</h3>
    
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($pizzaOrder, 'bread_price')->textInput(['type' => 'number', 'step' => '0.01']) ?>
    <?= $form->field($pizzaOrder, 'sausage_price')->textInput(['type' => 'number', 'step' => '0.01']) ?>
    <?= $form->field($pizzaOrder, 'toppings_price')->textInput(['type' => 'number', 'step' => '0.01']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save Prices', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?= Html::a('Back to Order Form', ['restaurant/view', 'id' => $pizzaOrder->restaurant_id], ['class' => 'btn btn-primary']) ?>
</div>
