<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

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
                        <?= $form->field($model, 'bread_types')->checkboxList(
                            ArrayHelper::map($breads, 'item_name', function ($model) {
                                                        return "{$model->item_name} (\${$model->price})";
                                                    }),
                            [
                                'class' => 'custom-checkbox-list'
                            ]
                        )->label(false) ?>
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label font-weight-bold">Sausage Types (Select multiple):</label>
                        <?= $form->field($model, 'sausage_types')->checkboxList(
                            ArrayHelper::map($sausages, 'item_name', function ($model) {
                                return "{$model->item_name} (\${$model->price})";
                            }),
                            [
                                'class' => 'custom-checkbox-list'
                            ]
                        )->label(false) ?>
                    </div>



                    <div class="form-group mb-4">
                        <label class="form-label font-weight-bold">Toppings (Select multiple):</label>
                        <?= $form->field($model, 'toppings')->checkboxList(
                            ArrayHelper::map($toppings, 'item_name', function ($model) {
                                return "{$model->item_name} (\${$model->price})";
                            }),
                            [
                                'class' => 'custom-checkbox-list'
                            ]
                        )->label(false) ?>
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