<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $menu app\models\Menu */
/* @var $categories array */

$this->title = 'Edit Menu Item: ' . $menu->name;
?>

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="card-body">
            <div class="menu-form">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                <div class="mb-3">
                    <?= $form->field($menu, 'name', [
                        'template' => "{label}\n{input}\n{error}",
                        'inputOptions' => ['class' => 'form-control', 'placeholder' => 'Enter menu item name'],
                    ])->label('Menu Item Name') ?>
                </div>

                <div class="mb-3">
                    <?= $form->field($menu, 'description', [
                        'template' => "{label}\n{input}\n{error}",
                        'inputOptions' => ['class' => 'form-control', 'placeholder' => 'Enter a description'],
                    ])->textarea()->label('Description') ?>
                </div>

                <div class="mb-3">
                    <?= $form->field($menu, 'price', [
                        'template' => "{label}\n{input}\n{error}",
                        'inputOptions' => ['class' => 'form-control', 'type' => 'number', 'placeholder' => 'Enter price'],
                    ])->label('Price ($)') ?>
                </div>

                <div class="mb-3">
                    <?= $form->field($menu, 'stock', [
                        'template' => "{label}\n{input}\n{error}",
                        'inputOptions' => ['class' => 'form-control', 'type' => 'number', 'min' => 1, 'placeholder' => 'Enter stock quantity'],
                    ])->label('Stock') ?>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select name="Menu[category]" id="category" class="form-select">
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= Html::encode($category) ?>" <?= $menu->category == $category ? 'selected' : '' ?>>
                                <?= Html::encode($category) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <?= $form->field($menu, 'photo', [
                        'template' => "{label}\n{input}\n{error}",
                    ])->fileInput(['class' => 'form-control'])->label('Upload New Photo') ?>
                </div>

                <div class="form-group text-center">
                    <?= Html::submitButton('Update', ['class' => 'btn btn-success btn-lg px-4']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
