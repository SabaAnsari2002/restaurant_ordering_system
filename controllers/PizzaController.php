<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class PizzaController extends Controller
{
    /**
     * انتخاب نان پیتزا
     */
    public function actionChooseBase()
    {
        // چک کردن ارسال فرم
        if (Yii::$app->request->isPost) {
            $base = Yii::$app->request->post('base'); // دریافت نان انتخابی
            Yii::$app->session->set('pizza_base', $base); // ذخیره در سشن
            return $this->redirect(['choose-sausage']); // هدایت به مرحله بعد
        }

        // نمایش ویو
        return $this->render('choose-base');
    }

    /**
     * انتخاب نوع سوسیس
     */
    public function actionChooseSausage()
    {
        if (Yii::$app->request->isPost) {
            $sausage = Yii::$app->request->post('sausage'); // دریافت نوع سوسیس
            Yii::$app->session->set('pizza_sausage', $sausage); // ذخیره در سشن
            return $this->redirect(['choose-topping']); // هدایت به مرحله بعد
        }

        return $this->render('choose-sausage');
    }

    /**
     * انتخاب تاپینگ‌ها
     */
    public function actionChooseTopping()
    {
        if (Yii::$app->request->isPost) {
            $toppings = Yii::$app->request->post('toppings'); // دریافت تاپینگ‌ها
            Yii::$app->session->set('pizza_toppings', $toppings); // ذخیره در سشن
            return $this->redirect(['summary']); // هدایت به صفحه خلاصه
        }

        return $this->render('choose-topping');
    }

    /**
     * نمایش خلاصه سفارش
     */
    public function actionSummary()
    {
        // دریافت اطلاعات ذخیره‌شده در سشن
        $base = Yii::$app->session->get('pizza_base');
        $sausage = Yii::$app->session->get('pizza_sausage');
        $toppings = Yii::$app->session->get('pizza_toppings');

        return $this->render('summary', [
            'base' => $base,
            'sausage' => $sausage,
            'toppings' => $toppings,
        ]);
    }
}
