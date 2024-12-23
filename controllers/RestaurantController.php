<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Restaurant;
use app\models\Menu;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use app\models\Order;
use yii\web\UploadedFile;

class RestaurantController extends Controller
{

    public function actionIndex()
    {
        $restaurant = Restaurant::findOne(['user_id' => Yii::$app->user->id]);

        if ($restaurant) {
            return $this->redirect(['view', 'id' => $restaurant->id]);
        }

        return $this->redirect(['create']);
    }

    public function actionCreate()
    {
        $model = new Restaurant();
        $model->user_id = Yii::$app->user->id;

        $categories = ['Appetizers', 'Soups', 'Salads', 'Main Courses', 'Desserts', 'Beverages', 'Snacks', 'Fast Food', 'Vegan', 'Kids'];

        if ($model->load(Yii::$app->request->post())) {
            $model->categories = json_encode(Yii::$app->request->post('categories', []));
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', ['model' => $model, 'categories' => $categories]);
    }

    public function actionView($id)
    {
        $restaurant = $this->findModel($id);
        $menus = $restaurant->getMenus()->all();

        return $this->render('view', ['restaurant' => $restaurant, 'menus' => $menus]);
    }

    public function actionAddMenu($id)
    {
        $restaurant = $this->findModel($id);
        $categories = json_decode($restaurant->categories, true);

        $menu = new Menu();
        $menu->restaurant_id = $id;

        if ($menu->load(Yii::$app->request->post())) {
            $uploadedFile = UploadedFile::getInstance($menu, 'photo');
            if ($uploadedFile) {
                $menu->photo = $uploadedFile->baseName . '.' . $uploadedFile->extension;
                $uploadedFile->saveAs('uploads/' . $menu->photo); // ذخیره فایل در پوشه 'uploads'
            }

            if ($menu->save()) {
                return $this->redirect(['view', 'id' => $restaurant->id]);
            }
        }

        return $this->render('add-menu', ['menu' => $menu, 'categories' => $categories]);
    }
    public function actionEditMenu($id, $menu_id)
    {
        $menu = Menu::findOne($menu_id);

        if (!$menu) {
            throw new NotFoundHttpException('The requested menu item does not exist.');
        }

        $restaurant = $menu->getRestaurant()->one();
        $categories = json_decode($restaurant->categories, true);

        if ($menu->load(Yii::$app->request->post()) && $menu->save()) {
            return $this->redirect(['view', 'id' => $menu->restaurant_id]);
        }

        return $this->render('edit-menu', ['menu' => $menu, 'categories' => $categories]);
    }


    protected function findModel($id)
    {
        if (($model = Restaurant::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUpdate($id)
    {
        $restaurant = $this->findModel($id);

        $categories = ['Appetizers', 'Soups', 'Salads', 'Main Courses', 'Desserts', 'Beverages', 'Snacks', 'Fast Food', 'Vegan', 'Kids'];

        if ($restaurant->load(Yii::$app->request->post())) {
            $restaurant->categories = json_encode(Yii::$app->request->post('categories', []));
            if ($restaurant->save()) {
                return $this->redirect(['view', 'id' => $id]);
            }
        }

        return $this->render('create', ['model' => $restaurant, 'categories' => $categories]);
    }

    public function actionDelete($id)
    {
        $restaurant = $this->findModel($id);
        $restaurant->delete();

        if (Yii::$app->request->isAjax) {
            return $this->asJson(['success' => true]);
        }

        return $this->redirect(['index']);
    }

    public function actionDeleteMenu($id)
    {
        $menu = Menu::findOne($id);

        if (!$menu) {
            throw new NotFoundHttpException('The requested menu item does not exist.');
        }

        $restaurantId = $menu->restaurant_id;
        $menu->delete();

        if (Yii::$app->request->isAjax) {
            return $this->asJson(['success' => true]);
        }

        return $this->redirect(['view', 'id' => $restaurantId]);
    }



    public function actionViewOrders($id)
    {
        $restaurant = $this->findModel($id);

        $orders = Order::find()->where(['restaurant_id' => $id])->all();

        return $this->render('view-orders', [
            'restaurant' => $restaurant,
            'orders' => $orders,
        ]);
    }

}
