<h1>انتخاب تاپینگ‌ها</h1>
<form method="post">
<?= \yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
<label>
        <input type="checkbox" name="toppings[]" value="زیتون"> زیتون
    </label>
    <label>
        <input type="checkbox" name="toppings[]" value="قارچ"> قارچ
    </label>
    <label>
        <input type="checkbox" name="toppings[]" value="فلفل دلمه‌ای"> فلفل دلمه‌ای
    </label>
    <button type="submit">خلاصه</button>
</form>
