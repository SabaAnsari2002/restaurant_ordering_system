<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create Restaurant';
?>

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="card-body">
            <div class="restaurant-form">
                <?php $form = ActiveForm::begin(); ?>

                <div class="mb-3">
                    <?= $form->field($model, 'name', [
                        'template' => "{label}\n{input}\n{error}",
                        'inputOptions' => ['class' => 'form-control', 'placeholder' => 'Enter restaurant name'],
                    ])->label('Restaurant Name') ?>
                </div>

                <div class="mb-3">
                    <?= $form->field($model, 'contact_number', [
                        'template' => "{label}\n{input}\n{error}",
                        'inputOptions' => ['class' => 'form-control', 'placeholder' => 'Enter contact number'],
                    ])->label('Contact Number') ?>
                </div>

                <div class="mb-3">
                    <?= $form->field($model, 'address', [
                        'template' => "{label}\n{input}\n{error}",
                        'inputOptions' => ['class' => 'form-control', 'placeholder' => 'Enter address'],
                    ])->label('Address') ?>
                </div>

                <div class="mb-4">
                    <h4>Categories</h4>
                    <div class="form-check">
                        <?php foreach ($categories as $category): ?>
                            <label class="form-check-label">
                                <input type="checkbox" name="categories[]" value="<?= Html::encode($category) ?>" class="form-check-input">
                                <?= Html::encode($category) ?>
                            </label><br>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="form-group text-center">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-lg px-4']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
