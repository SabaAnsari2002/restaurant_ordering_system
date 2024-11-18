<?php
use yii\helpers\Html;
use yii\bootstrap5\Alert;

$this->title = 'Home';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="jumbotron text-center bg-light p-5 rounded">
        <h1 class="display-4"><?= Html::encode($this->title) ?></h1>
        <p class="lead">Welcome to our platform!</p>
    </div>

    <div class="body-content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php if (Yii::$app->user->isGuest): ?>
                    <div class="text-center mt-4">
                        <p class="lead">Join us to access exciting features!</p>
                        <?= Html::a('Login', ['login'], ['class' => 'btn btn-primary btn-lg']) ?>
                    </div>
                <?php else: ?>
                    <?php $user = Yii::$app->user->identity; ?>
                    <div class="text-center mt-4">
                        <p class="lead">Hello, <strong><?= Html::encode($user->username) ?></strong>!</p>
                    </div>
                    <div class="text-center mt-4">
                        <?php if ($user->role === 'customer'): ?>
                            <?= Html::a('View Menu', ['menu/index'], ['class' => 'btn btn-info btn-lg me-2']) ?>
                        <?php elseif ($user->role === 'restaurant'): ?>
                            <?= Html::a('Restaurant Panel', ['restaurant/index'], ['class' => 'btn btn-info btn-lg me-2']) ?>
                        <?php endif; ?>
                        <?= Html::a('Logout', ['site/logout'], ['class' => 'btn btn-danger btn-lg', 'data-method' => 'post']) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
