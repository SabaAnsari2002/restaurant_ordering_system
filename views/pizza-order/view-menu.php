<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Choose Bread Types and Toppings';
$this->params['breadcrumbs'][] = ['label' => 'Restaurants', 'url' => ['menu/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container my-5">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p class="text-muted text-center">Select your desired bread types, sausage types, and toppings.</p>

    <?php if ($pizzaOrder): ?>

<!-- Display bread types -->
<div class="my-4">
    <h3>Bread Types</h3>
    <?php 
    // Check if $pizzaOrder->bread_types is a string, and if so, explode it
    if (is_string($pizzaOrder->bread_types)) {
        $breadTypes = explode(',', $pizzaOrder->bread_types);
    } else {
        // If it's already an array, use it directly
        $breadTypes = $pizzaOrder->bread_types;
    }
    ?>
    
    <?php foreach ($breadTypes as $bread): ?>
        <div>
            <?= Html::checkbox("bread_types[$bread]", false, [
                'label' => Html::encode($bread),
            ]) ?>
        </div>
    <?php endforeach; ?>
</div>

<!-- Display sausage types -->
<div class="my-4">
    <h3>Sausage Types</h3>
    <?php 
    // Check if $pizzaOrder->sausage_types is a string, and if so, explode it
    if (is_string($pizzaOrder->sausage_types)) {
        $sausageTypes = explode(',', $pizzaOrder->sausage_types);
    } else {
        // If it's already an array, use it directly
        $sausageTypes = $pizzaOrder->sausage_types;
    }
    ?>
    <?php foreach ($sausageTypes as $sausage): ?>
        <div>
            <?= Html::checkbox("sausage_types[$sausage]", false, [
                'label' => Html::encode($sausage),
            ]) ?>
        </div>
    <?php endforeach; ?>
</div>

<!-- Display toppings -->
<div class="my-4">
    <h3>Toppings</h3>
    <?php 
    // Check if $pizzaOrder->toppings is a string, and if so, explode it
    if (is_string($pizzaOrder->toppings)) {
        $toppings = explode(',', $pizzaOrder->toppings);
    } else {
        // If it's already an array, use it directly
        $toppings = $pizzaOrder->toppings;
    }
    ?>
    <?php foreach ($toppings as $topping): ?>
        <div>
            <?= Html::checkbox("toppings[$topping]", false, [
                'label' => Html::encode($topping),
            ]) ?>
        </div>
    <?php endforeach; ?>
</div>

<!-- Submit button -->
<div class="text-center mt-4">
    <?= Html::submitButton('Submit Selection', ['class' => 'btn btn-primary btn-lg']) ?>
</div>

<?php else: ?>
<p class="text-center text-danger">No pizza order data available for this restaurant.</p>
<?php endif; ?>
