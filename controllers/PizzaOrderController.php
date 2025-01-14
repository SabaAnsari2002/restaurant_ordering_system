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

    public function actionView($restaurant_id)
    {
        $restaurant = Restaurant::findOne($restaurant_id);

        if (!$restaurant) {
            throw new NotFoundHttpException('The requested restaurant does not exist.');
        }

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

    public function actionCreate($restaurant_id)
    {
        $restaurant = Restaurant::findOne($restaurant_id);

        if (!$restaurant) {
            throw new NotFoundHttpException('The requested restaurant does not exist.');
        }

        PizzaOrder::deleteAll(['restaurant_id' => $restaurant_id]);

        $model = new PizzaOrder();
        $model->restaurant_id = $restaurant_id;

        $breads = MenuItems::find()
            ->where(['item_type' => 'bread'])
            ->all();

        $sausages = MenuItems::find()
            ->where(['item_type' => 'sausage']) 
            ->all();

        $toppings = MenuItems::find()
            ->where(['item_type' => 'topping']) 
            ->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Order placed successfully!');
            return $this->redirect(['view', 'restaurant_id' => $restaurant_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'restaurant' => $restaurant,
            'breads' => $breads, 
            'sausages' => $sausages, 
            'toppings' => $toppings, 
        ]);
    }

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

    public function actionViewMenu($restaurant_id)
    {
        $restaurant = Restaurant::findOne($restaurant_id);

        if (!$restaurant) {
            throw new NotFoundHttpException('The requested restaurant does not exist.');
        }

        $pizzaOrder = PizzaOrder::find()
            ->where(['restaurant_id' => $restaurant_id])
            ->one();

        if (!$pizzaOrder) {
            throw new NotFoundHttpException('No pizza order data found for this restaurant.');
        }

        $breadTypes = is_array($pizzaOrder->bread_types) ? $pizzaOrder->bread_types : explode(',', $pizzaOrder->bread_types);
        $sausageTypes = is_array($pizzaOrder->sausage_types) ? $pizzaOrder->sausage_types : explode(',', $pizzaOrder->sausage_types);
        $toppingTypes = is_array($pizzaOrder->toppings) ? $pizzaOrder->toppings : explode(',', $pizzaOrder->toppings);

        $breads = MenuItems::find()
            ->where(['item_type' => 'bread'])
            ->andWhere(['item_name' => $breadTypes])
            ->all();

        $sausages = MenuItems::find()
            ->where(['item_type' => 'sausage'])
            ->andWhere(['item_name' => $sausageTypes])
            ->all();

        $toppings = MenuItems::find()
            ->where(['item_type' => 'topping'])
            ->andWhere(['item_name' => $toppingTypes])
            ->all();

        return $this->render('view-menu', [
            'pizzaOrder' => $pizzaOrder,
            'restaurant' => $restaurant,
            'breads' => $breads,
            'sausages' => $sausages,
            'toppings' => $toppings,
        ]);
    }

    public function actionDisplaySelection($restaurant_id)
    {
        $selectedBreadTypes = Yii::$app->request->post('bread_types', []);
        $selectedSausageTypes = Yii::$app->request->post('sausage_types', []);
        $selectedToppings = Yii::$app->request->post('toppings', []);

        return $this->render('display-selection', [
            'selectedBreadTypes' => $selectedBreadTypes,
            'selectedSausageTypes' => $selectedSausageTypes,
            'selectedToppings' => $selectedToppings,
        ]);
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

    $totalPrice = 0;

    // Fetching prices from database
    $breadItems = MenuItems::find()->where(['item_name' => $selectedBreadTypes, 'item_type' => 'bread'])->all();
    $sausageItems = MenuItems::find()->where(['item_name' => $selectedSausageTypes, 'item_type' => 'sausage'])->all();
    $toppingItems = MenuItems::find()->where(['item_name' => $selectedToppings, 'item_type' => 'topping'])->all();

    $breadData = [];
    $sausageData = [];
    $toppingData = [];

    foreach ($breadItems as $item) {
        $breadData[] = ['name' => $item->item_name, 'price' => $item->price];
        $totalPrice += $item->price;
    }

    foreach ($sausageItems as $item) {
        $sausageData[] = ['name' => $item->item_name, 'price' => $item->price];
        $totalPrice += $item->price;
    }

    foreach ($toppingItems as $item) {
        $toppingData[] = ['name' => $item->item_name, 'price' => $item->price];
        $totalPrice += $item->price;
    }

    return $this->render('display-selection', [
        'breadData' => $breadData,
        'sausageData' => $sausageData,
        'toppingData' => $toppingData,
        'totalPrice' => $totalPrice,
    ]);
}


}
