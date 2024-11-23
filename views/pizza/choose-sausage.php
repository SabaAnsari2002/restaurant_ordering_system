<h1>انتخاب نوع سوسیس</h1>
<form method="post">
<?= \yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
<label>
        <input type="radio" name="sausage" value="سوسیس دودی"> سوسیس دودی
    </label>
    <label>
        <input type="radio" name="sausage" value="سوسیس مرغ"> سوسیس مرغ
    </label>
    <button type="submit">بعدی</button>
</form>
