<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PizzaOrder */
/* @var $restaurant app\models\Restaurant */

$this->title = 'Create Pizza Order for ' . Html::encode($restaurant->name);
?>

<div class="pizza-order-create container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h3><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="card-body">

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'restaurant_id')->hiddenInput()->label(false) ?>

                    <div class="form-group mb-4">
                        <label class="form-label font-weight-bold">Bread Types (Select multiple):</label>
                        <?= $form->field($model, 'bread_types')->checkboxList([
                            'Neapolitan Crust' => 'Neapolitan Crust',
                            'Thin Crust' => 'Thin Crust',
                            'Thick Crust' => 'Thick Crust',
                            'New York Style' => 'New York Style',
                            'Chicago Deep Dish' => 'Chicago Deep Dish',
                        ], [
                            'class' => 'custom-checkbox-list'
                        ])->label(false) ?>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label font-weight-bold">Sausage Types (Select multiple):</label>
                        <?= $form->field($model, 'sausage_types')->checkboxList([
                            'Pepperoni' => 'Pepperoni',
                            'Salami' => 'Salami',
                            'Italian Sausage' => 'Italian Sausage',
                            'Ham' => 'Ham',
                            'Capicola' => 'Capicola',
                        ], [
                            'class' => 'custom-checkbox-list'
                        ])->label(false) ?>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label font-weight-bold">Toppings (Select multiple):</label>
                        <?= $form->field($model, 'toppings')->checkboxList([
                            'Mozzarella Cheese' => 'Mozzarella Cheese',
                            'Cheddar Cheese' => 'Cheddar Cheese',
                            'Parmesan Cheese' => 'Parmesan Cheese',
                            'Ricotta Cheese' => 'Ricotta Cheese',
                            'Mushrooms' => 'Mushrooms',
                            'Olives' => 'Olives',
                            'Bell Peppers' => 'Bell Peppers',
                            'Onions' => 'Onions',
                            'Fresh Basil' => 'Fresh Basil',
                            'Fresh Tomatoes' => 'Fresh Tomatoes',
                            'Spinach' => 'Spinach',
                            'Corn' => 'Corn',
                            'Garlic ' => 'Garlic ',
                            'Thyme' => 'Thyme',
                            'Red Chili Flakes' => 'Red Chili Flakes',
                            'Paprika Powder' => 'Paprika Powder',
                        ], [
                            'class' => 'custom-checkbox-list'
                        ])->label(false) ?>
                    </div>

                    <div class="form-group text-center">
                    <div class="form-group text-center">
    <?= Html::submitButton('<i class="fas fa-pizza-slice"></i> Place Order', ['class' => 'btn btn-success btn-lg px-4']) ?>
</div>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .custom-checkbox-list .form-check {
        margin-bottom: 0.5rem;
    }

    .custom-checkbox-list .form-check-input {
        margin-right: 0.5rem;
    }

    .form-label {
        font-size: 1.1rem;
    }
</style>
