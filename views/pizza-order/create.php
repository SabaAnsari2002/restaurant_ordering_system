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
                            'Neapolitan Crust' => 'Neapolitan Crust ($5)',
                            'Thin Crust' => 'Thin Crust ($4)',
                            'Thick Crust' => 'Thick Crust ($6)',
                            'New York Style' => 'New York Style ($7)',
                            'Chicago Deep Dish' => 'Chicago Deep Dish ($8)',
                        ], [
                            'class' => 'custom-checkbox-list'
                        ])->label(false) ?>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label font-weight-bold">Sausage Types (Select multiple):</label>
                        <?= $form->field($model, 'sausage_types')->checkboxList([
                            'Pepperoni' => 'Pepperoni ($3)',
                            'Salami' => 'Salami ($4)',
                            'Italian Sausage' => 'Italian Sausage ($5)',
                            'Ham' => 'Ham ($3.5)',
                            'Capicola' => 'Capicola ($4.5)',
                        ], [
                            'class' => 'custom-checkbox-list'
                        ])->label(false) ?>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label font-weight-bold">Toppings (Select multiple):</label>
                        <?= $form->field($model, 'toppings')->checkboxList([
                            'Mozzarella Cheese' => 'Mozzarella Cheese ($2)',
                            'Cheddar Cheese' => 'Cheddar Cheese ($2.5)',
                            'Parmesan Cheese' => 'Parmesan Cheese ($3)',
                            'Ricotta Cheese' => 'Ricotta Cheese ($2)',
                            'Mushrooms' => 'Mushrooms ($1.5)',
                            'Olives' => 'Olives ($1.5)',
                            'Bell Peppers' => 'Bell Peppers ($1)',
                            'Onions' => 'Onions ($1)',
                            'Fresh Basil' => 'Fresh Basil ($0.5)',
                            'Fresh Tomatoes' => 'Fresh Tomatoes ($1)',
                            'Spinach' => 'Spinach ($1)',
                            'Corn' => 'Corn ($1)',
                            'Garlic' => 'Garlic ($0.5)',
                            'Thyme' => 'Thyme ($0.5)',
                            'Red Chili Flakes' => 'Red Chili Flakes ($0.5)',
                            'Paprika Powder' => 'Paprika Powder ($0.5)',
                        ], [
                            'class' => 'custom-checkbox-list'
                        ])->label(false) ?>
                    </div>

                    <div class="form-group text-center">
                        <?= Html::submitButton('<i class="fas fa-pizza-slice"></i> Place Order', ['class' => 'btn btn-success btn-lg px-4']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Optional: Calculate total price dynamically
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.custom-checkbox-list input[type="checkbox"]');
        const totalDisplay = document.createElement('div');
        totalDisplay.classList.add('mt-3', 'text-center');
        totalDisplay.innerHTML = '<strong>Total Price: $0</strong>';
        document.querySelector('.card-body').appendChild(totalDisplay);

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                let total = 0;
                checkboxes.forEach(cb => {
                    if (cb.checked) {
                        const price = parseFloat(cb.parentElement.innerText.match(/\$(\d+\.?\d*)/)[1]);
                        total += price;
                    }
                });
                totalDisplay.innerHTML = `<strong>Total Price: $${total.toFixed(2)}</strong>`;
            });
        });
    });
</script>
