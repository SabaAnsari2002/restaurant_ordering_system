<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\PizzaOrder;
use app\models\Restaurant;
use yii\web\NotFoundHttpException;

class PizzaOrderController extends Controller
{
    public function actionCreate($restaurant_id)
    {
        $restaurant = Restaurant::findOne($restaurant_id);

        if (!$restaurant) {
            throw new NotFoundHttpException('The requested restaurant does not exist.');
        }

        // حذف سفارش قبلی در صورت وجود
        PizzaOrder::deleteExistingOrder($restaurant_id);

        $model = new PizzaOrder();
        $model->restaurant_id = $restaurant_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Order placed successfully!');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'restaurant' => $restaurant,
        ]);
    }

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
