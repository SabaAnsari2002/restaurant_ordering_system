<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>انتخاب نوع سوسیس</title>
    <style>
        body {
            font-family: "IRANSans", Arial, sans-serif;
            background-color: #f3f4f6;
            color: #333;
            text-align: center;
            padding: 20px;
        }
        h1 {
            font-size: 26px;
            margin-bottom: 25px;
            color: #d32f2f;
        }
        form {
            display: inline-block;
            background-color: #fff;
            padding: 25px;
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
        input[type="radio"] {
            margin-right: 10px;
        }
        button {
            display: block;
            width: 100%;
            background-color: #d32f2f;
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
            background-color: #e53935;
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
</body>
</html>
