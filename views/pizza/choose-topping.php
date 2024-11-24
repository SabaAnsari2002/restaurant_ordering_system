<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>انتخاب تاپینگ‌ها</title>
    <style>
        body {
            font-family: "IRANSans", Arial, sans-serif;
            background-color: #f4f6f8;
            color: #333;
            text-align: center;
            padding: 20px;
        }
        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #388e3c;
        }
        form {
            display: inline-block;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            text-align: left;
        }
        label {
            display: flex;
            align-items: center;
            margin: 10px 0;
            font-size: 18px;
            cursor: pointer;
            color: #555;
        }
        input[type="checkbox"] {
            margin-left: 10px;
            transform: scale(1.2);
            cursor: pointer;
        }
        button {
            display: block;
            width: 100%;
            background-color: #388e3c;
            color: #fff;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #4caf50;
        }
        @media (max-width: 480px) {
            form {
                padding: 15px;
            }
            label {
                font-size: 16px;
            }
            button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
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
</body>
</html>
