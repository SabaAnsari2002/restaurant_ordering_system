<?php
use yii\helpers\Html;

$this->title = 'Home';
?>
<h1>Welcome!</h1>
<?php if (Yii::$app->user->isGuest): ?>
    <?= Html::a('Login', ['login'], ['class' => 'btn btn-primary']) ?>
<?php else: ?>
    <?php $user = Yii::$app->user->identity; ?>
    <p>Hello, <?= Html::encode($user->username) ?>!</p>
    <?php if ($user->role === 'customer'): ?>
        <?= Html::a('View Menu', ['menu/index'], ['class' => 'btn btn-info']) ?>
    <?php elseif ($user->role === 'restaurant'): ?>
        <?= Html::a('Restaurant Panel', ['restaurant/index'], ['class' => 'btn btn-info']) ?>
    <?php endif; ?>
    <?= Html::a('Logout', ['site/logout'], ['class' => 'btn btn-danger', 'data-method' => 'post']) ?>
<?php endif; ?>
