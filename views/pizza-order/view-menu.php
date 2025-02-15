<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Pizza Order Menu';
$this->params['breadcrumbs'][] = ['label' => 'Restaurants', 'url' => ['restaurant/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container my-5">
    <h1 class="text-center mb-4">Pizza Order Menu</h1>

    <?php if ($pizzaOrder): ?>

        <?php $form = ActiveForm::begin([
            'action' => ['pizza-order/submit-selection', 'restaurant_id' => $restaurant->id],
            'method' => 'post',
        ]); ?>

        <!-- Bread Types -->
        <div class="my-4">
            <h3>Bread Types</h3>
            <?php foreach ($breads as $bread): ?>
                <div>
                    <?= Html::checkbox("bread_types[]", false, [
                        'value' => $bread->item_name,
                        'label' => Html::encode($bread->item_name . ' - $' . number_format($bread->price, 2))
                    ]) ?>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Sausage Types -->
        <div class="my-4">
            <h3>Sausage Types</h3>
            <?php foreach ($sausages as $sausage): ?>
                <div>
                    <?= Html::checkbox("sausage_types[]", false, [
                        'value' => $sausage->item_name,
                        'label' => Html::encode($sausage->item_name . ' - $' . number_format($sausage->price, 2))
                    ]) ?>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Toppings -->
        <div class="my-4">
            <h3>Toppings</h3>
            <?php foreach ($toppings as $topping): ?>
                <div>
                    <?= Html::checkbox("toppings[]", false, [
                        'value' => $topping->item_name,
                        'label' => Html::encode($topping->item_name . ' - $' . number_format($topping->price, 2))
                    ]) ?>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Submit Button -->
        <div class="text-center mt-4">
            <?= Html::submitButton('Submit Selection', ['class' => 'btn btn-primary btn-lg']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    <?php else: ?>
        <p class="text-center text-danger">No pizza order data available for this restaurant.</p>
    <?php endif; ?>
</div>

<?php
$this->registerJs(<<<JS
    document.querySelector('form').addEventListener('submit', function(e) {
        let breadChecked = document.querySelectorAll('input[name="bread_types[]"]:checked').length > 0;
        let sausageChecked = document.querySelectorAll('input[name="sausage_types[]"]:checked').length > 0;
        let toppingsChecked = document.querySelectorAll('input[name="toppings[]"]:checked').length > 0;

        if (!breadChecked || !sausageChecked || !toppingsChecked) {
            e.preventDefault();
            alert('Please select at least one option from each category: Bread Types, Sausage Types, and Toppings.');
        }
    });
JS
);
?>
