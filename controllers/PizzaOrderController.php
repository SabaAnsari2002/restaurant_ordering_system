<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\PizzaOrder;
use app\models\Restaurant;
use app\models\Menu;

use yii\web\NotFoundHttpException;

class PizzaOrderController extends Controller
{
    /**
     * Action to display the list of bread types, sausage types, and toppings
     * for a specific restaurant.
     */
    // public function actionView($restaurant_id)
    // {
    //     // Find the restaurant
    //     $restaurant = Restaurant::findOne($restaurant_id);

    //     if (!$restaurant) {
    //         throw new NotFoundHttpException('The requested restaurant does not exist.');
    //     }

    //     // Fetch the related PizzaOrder data for the restaurant
    //     $pizzaOrder = PizzaOrder::find()
    //         ->where(['restaurant_id' => $restaurant_id])
    //         ->one();

    //     if (!$pizzaOrder) {
    //         throw new NotFoundHttpException('No order data found for this restaurant.');
    //     }

    //     return $this->render('view', [
    //         'pizzaOrder' => $pizzaOrder,
    //         'restaurant' => $restaurant,
    //     ]);
    // }

    /**
     * Action to create or update an order for a specific restaurant.
     */
    

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

    return $this->render('view-menu', [
        'pizzaOrder' => $pizzaOrder, // Pass pizzaOrder to the view
        'restaurant' => $restaurant, // Optionally pass restaurant details
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

    // If the form is submitted to save prices
    if ($pizzaOrder->load(Yii::$app->request->post()) && $pizzaOrder->save()) {
        Yii::$app->session->setFlash('success', 'Prices saved successfully!');
        return $this->redirect(['view', 'restaurant_id' => $restaurant_id]);
    }

    return $this->render('view', [
        'pizzaOrder' => $pizzaOrder,
        'restaurant' => $restaurant,
    ]);
}

public function actionCreate($restaurant_id)
{
    $restaurant = Restaurant::findOne($restaurant_id);

    if (!$restaurant) {
        throw new NotFoundHttpException('The requested restaurant does not exist.');
    }

    // اگر سفارش قبلی وجود دارد، آن را حذف کنید
    PizzaOrder::deleteExistingOrder($restaurant_id);

    $model = new PizzaOrder();
    $model->restaurant_id = $restaurant_id;

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        // بعد از ذخیره‌سازی، به صفحه جزئیات هدایت شوید
        return $this->redirect(['view', 'restaurant_id' => $restaurant_id]);
    }

    return $this->render('create', [
        'model' => $model,
        'restaurant' => $restaurant,
    ]);
}



}
