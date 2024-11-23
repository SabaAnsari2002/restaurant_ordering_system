<h1>خلاصه سفارش شما</h1>
<p>نان: <?= htmlspecialchars($base) ?></p>
<p>سوسیس: <?= htmlspecialchars($sausage) ?></p>
<p>تاپینگ‌ها:</p>
<ul>
    <?php foreach ($toppings as $topping): ?>
        <li><?= htmlspecialchars($topping) ?></li>
    <?php endforeach; ?>
</ul>
<a href="/">بازگشت به صفحه اصلی</a>
