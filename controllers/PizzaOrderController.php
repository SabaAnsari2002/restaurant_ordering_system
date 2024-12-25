<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\PizzaOrder;
use app\models\Restaurant;
use app\models\Menu;
use app\models\MenuItems;

use yii\web\NotFoundHttpException;

class PizzaOrderController extends Controller
{
    /**
     * Action to display the list of bread types, sausage types, and toppings
     * for a specific restaurant.
     */
    public function actionView($restaurant_id)
    {
        // Find the restaurant
        $restaurant = Restaurant::findOne($restaurant_id);

        if (!$restaurant) {
            throw new NotFoundHttpException('The requested restaurant does not exist.');
        }

        // Fetch the related PizzaOrder data for the restaurant
        $pizzaOrder = PizzaOrder::find()
            ->where(['restaurant_id' => $restaurant_id])
            ->one();

        if (!$pizzaOrder) {
            throw new NotFoundHttpException('No order data found for this restaurant.');
        }

        return $this->render('view', [
            'pizzaOrder' => $pizzaOrder,
            'restaurant' => $restaurant,
        ]);
    }

    /**
     * Action to create or update an order for a specific restaurant.
     */
    public function actionCreate($restaurant_id)
{
    $restaurant = Restaurant::findOne($restaurant_id);

    if (!$restaurant) {
        throw new NotFoundHttpException('The requested restaurant does not exist.');
    }

    // حذف سفارش‌های قبلی
    PizzaOrder::deleteAll(['restaurant_id' => $restaurant_id]);

    $model = new PizzaOrder();
    $model->restaurant_id = $restaurant_id;

    // بارگذاری نان‌ها از دیتابیس
    $breads = MenuItems::find()
        ->where(['item_type' => 'bread']) // فرض بر این است که نوع نان‌ها 'bread' است
        ->all();

    // بارگذاری سوسیس‌ها از دیتابیس
    $sausages = MenuItems::find()
        ->where(['item_type' => 'sausage']) // فرض بر این است که نوع سوسیس‌ها 'sausage' است
        ->all();

    // بارگذاری تاپینگ‌ها از دیتابیس
    $toppings = MenuItems::find()
        ->where(['item_type' => 'topping']) // فرض بر این است که نوع تاپینگ‌ها 'topping' است
        ->all();

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        Yii::$app->session->setFlash('success', 'Order placed successfully!');
        return $this->redirect(['view', 'restaurant_id' => $restaurant_id]);
    }

    return $this->render('create', [
        'model' => $model,
        'restaurant' => $restaurant,
        'breads' => $breads, // ارسال نان‌ها به ویو
        'sausages' => $sausages, // ارسال سوسیس‌ها به ویو
        'toppings' => $toppings, // ارسال تاپینگ‌ها به ویو
    ]);
}


    /**
     * Action to delete an order for a specific restaurant.
     */
    public function actionDelete($id)
    {
        $model = PizzaOrder::findOne($id);

        if (!$model) {
            throw new NotFoundHttpException('The requested order does not exist.');
        }

        $model->delete();
        Yii::$app->session->setFlash('success', 'Order deleted successfully!');

        return $this->redirect(['restaurant/index']);
    }
//     public function actionSubmitSelection($restaurant_id)
// {
//     $selectedBreadTypes = Yii::$app->request->post('bread_types');
//     $selectedSausageTypes = Yii::$app->request->post('sausage_types');
//     $selectedToppings = Yii::$app->request->post('toppings');

//     if ($selectedBreadTypes || $selectedSausageTypes || $selectedToppings) {
//         // انجام عملیات ذخیره یا پردازش انتخاب‌ها
//         Yii::$app->session->setFlash('success', 'Your selection has been saved successfully!');
//     } else {
//         Yii::$app->session->setFlash('error', 'Please select at least one option.');
//     }

//     // بازگشت به صفحه لیست
//     return $this->redirect(['pizza-order/view', 'restaurant_id' => $restaurant_id]);
// }

public function actionSubmitSelection($restaurant_id)
{
    $selectedBreadTypes = Yii::$app->request->post('bread_types', []);
    $selectedSausageTypes = Yii::$app->request->post('sausage_types', []);
    $selectedToppings = Yii::$app->request->post('toppings', []);

    if (empty($selectedBreadTypes) || empty($selectedSausageTypes) || empty($selectedToppings)) {
        Yii::$app->session->setFlash('error', 'You must select at least one option from each category: Bread Types, Sausage Types, and Toppings.');
        return $this->redirect(['view-menu', 'restaurant_id' => $restaurant_id]);
    }

    return $this->render('display-selection', [
        'selectedBreadTypes' => $selectedBreadTypes,
        'selectedSausageTypes' => $selectedSausageTypes,
        'selectedToppings' => $selectedToppings,
    ]);
}



public function actionViewMenu($restaurant_id)
{
    // Find the restaurant
    $restaurant = Restaurant::findOne($restaurant_id);

    if (!$restaurant) {
        throw new NotFoundHttpException('The requested restaurant does not exist.');
    }

    // Fetch the related PizzaOrder data for the restaurant
    $pizzaOrder = PizzaOrder::find()
        ->where(['restaurant_id' => $restaurant_id])
        ->one();

    if (!$pizzaOrder) {
        throw new NotFoundHttpException('No pizza order data found for this restaurant.');
    }

    // بارگذاری قیمت‌های نان‌ها
    $breads = MenuItems::find()
        ->where(['item_type' => 'bread'])
        ->all();

    // بارگذاری قیمت‌های سوسیس‌ها
    $sausages = MenuItems::find()
        ->where(['item_type' => 'sausage'])
        ->all();

    // بارگذاری تاپینگ‌های موجود در سفارش
    // اطمینان حاصل کنید که toppings یک رشته است
    $orderedToppings = is_string($pizzaOrder->toppings) ? explode(',', $pizzaOrder->toppings) : [];

    // بارگذاری قیمت‌های تاپینگ‌ها فقط برای مواردی که در سفارش هستند
    $toppings = MenuItems::find()
        ->where(['item_type' => 'topping'])
        ->andWhere(['item_name' => $orderedToppings]) // فیلتر بر اساس تاپینگ‌های موجود در سفارش
        ->all();

    return $this->render('view-menu', [
        'pizzaOrder' => $pizzaOrder,
        'restaurant' => $restaurant,
        'breads' => $breads, // ارسال نان‌ها به ویو
        'sausages' => $sausages, // ارسال سوسیس‌ها به ویو
        'toppings' => $toppings, // ارسال فقط تاپینگ‌های موجود به ویو
    ]);
}




public function actionDisplaySelection($restaurant_id)
{
    // دریافت اطلاعات ارسال‌شده
    $selectedBreadTypes = Yii::$app->request->post('bread_types', []);
    $selectedSausageTypes = Yii::$app->request->post('sausage_types', []);
    $selectedToppings = Yii::$app->request->post('toppings', []);

    // داده‌ها را به ویو ارسال کنید
    return $this->render('display-selection', [
        'selectedBreadTypes' => $selectedBreadTypes,
        'selectedSausageTypes' => $selectedSausageTypes,
        'selectedToppings' => $selectedToppings,
    ]);
}

}
