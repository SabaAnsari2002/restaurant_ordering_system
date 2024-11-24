<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خلاصه سفارش</title>
    <style>
        /* استایل‌های مخصوص بخش خلاصه سفارش */
        .summary-container {
            max-width: 600px;
            margin: 50px auto; /* فاصله از بالا برای جدا شدن از فرم */
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border: 1px solid #ddd;
        }
        .summary-container h1 {
            color: #444;
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
        }
        .summary-container p {
            font-size: 18px;
            margin: 10px 0;
        }
        .summary-container ul {
            list-style: none;
            padding: 0;
            margin: 10px 0;
        }
        .summary-container ul li {
            background-color: #f0f0f0;
            margin: 5px 0;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .summary-container a {
            display: block;
            text-align: center;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .summary-container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <!-- بخش خلاصه سفارش -->
    <div class="summary-container">
        <h1>خلاصه سفارش شما</h1>
        <p><strong>نان:</strong> <?= htmlspecialchars($base) ?></p>
        <p><strong>سوسیس:</strong> <?= htmlspecialchars($sausage) ?></p>
        <p><strong>تاپینگ‌ها:</strong></p>
        <ul>
            <?php foreach ($toppings as $topping): ?>
                <li><?= htmlspecialchars($topping) ?></li>
            <?php endforeach; ?>
        </ul>
        <a href="/">بازگشت به صفحه اصلی</a>
    </div>
</body>
</html>
