<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\PizzaOrder;
use yii\web\NotFoundHttpException;

class PizzaOrderController extends Controller
{
    public function actionCreate()
    {
        $model = new PizzaOrder();

        // بررسی ارسال داده‌ها و ذخیره آنها در دیتابیس
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // اگر داده‌ها با موفقیت ذخیره شدند
            Yii::$app->session->setFlash('success', 'Order placed successfully!');
            // انتقال به صفحه ویو پس از ثبت سفارش
            return $this->redirect(['view', 'id' => $model->id]);
        }

        // اگر فرم ارسال نشده باشد، فرم را نمایش می‌دهیم
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    // اکشن برای نمایش جزئیات سفارش
    public function actionView($id)
    {
        $model = PizzaOrder::findOne($id);

        if (!$model) {
            throw new NotFoundHttpException('The requested order does not exist.');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }
}
