<h1>انتخاب نان پیتزا</h1>
<form method="post">
    <?= \yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
    <label>
        <input type="radio" name="base" value="نان نازک"> نان نازک
    </label>
    <label>
        <input type="radio" name="base" value="نان ضخیم"> نان ضخیم
    </label>
    <button type="submit">ادامه</button>
</form>
