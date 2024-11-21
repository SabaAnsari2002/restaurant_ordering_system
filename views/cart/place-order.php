<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Place Order';
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm rounded">
                <div class="card-header bg-primary text-white text-center">
                    <h2 class="mb-0"><?= Html::encode($this->title) ?></h2>
                </div>
                <div class="card-body">
                    <?php $form = ActiveForm::begin(); ?>

                    <div class="form-group">
                        <?= $form->field($order, 'customer_name')
                            ->textInput(['value' => Yii::$app->user->identity->username, 'readonly' => true, 'class' => 'form-control-plaintext font-weight-bold'])
                            ->label('Customer Name', ['class' => 'font-weight-bold']); ?>
                    </div>

                    <div class="form-group">
                        <?= $form->field($order, 'phone_number')
                            ->textInput(['maxlength' => true, 'class' => 'form-control'])
                            ->label('Phone Number', ['class' => 'font-weight-bold']); ?>
                    </div>

                    <div class="form-group">
                        <?= $form->field($order, 'address')
                            ->textarea(['rows' => 4, 'class' => 'form-control'])
                            ->label('Delivery Address', ['class' => 'font-weight-bold']); ?>
                    </div>

                    <?= $form->field($order, 'restaurant_id')->hiddenInput(['value' => $restaurantId])->label(false) ?>

                    <div class="form-group text-center mt-4">
                        <?= Html::submitButton('Place Order', ['class' => 'btn btn-success btn-lg px-5']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
    .card {
        border-radius: 10px;
        border: none;
    }

    .card-header {
        border-bottom: 2px solid #fff;
    }

    .form-control {
        border: 2px solid #ced4da;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .btn-success {
        background-color: #28a745;
        border: none;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-success:hover {
        background-color: #218838;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.4);
    }

    .font-weight-bold {
        font-weight: 600;
    }

    .container h2 {
        font-size: 1.75rem;
        font-weight: bold;
        color: #333;
    }

    textarea.form-control {
        resize: none;
    }
</style>
