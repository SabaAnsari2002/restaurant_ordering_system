<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Restaurant;
use app\models\Menu;
use yii\web\NotFoundHttpException;
use yii\web\Response;

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

    // ایجاد یک شیء Menu جدید
    $menu = new Menu();
    $menu->restaurant_id = $id;

    // اگر داده‌ها از فرم بارگذاری شده باشند و عملیات ذخیره موفقیت‌آمیز باشد
    if ($menu->load(Yii::$app->request->post())) {
        // در اینجا ذخیره می‌شود
        if ($menu->save()) {
            // پس از ذخیره، به صفحه قبلی برمی‌گردیم و داده‌های جدید نمایش داده می‌شوند
            return $this->redirect(['view', 'id' => $restaurant->id]);
        }
    }

    return $this->render('add-menu', ['menu' => $menu, 'categories' => $categories]);
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

    public function actionEditMenu($id, $menu_id)
    {
        $menu = Menu::findOne($menu_id);

        if (!$menu) {
            throw new NotFoundHttpException('The requested menu item does not exist.');
        }

        // Use the 'restaurant' relation method to get the associated restaurant
        $restaurant = $menu->restaurant;
        $categories = json_decode($restaurant->categories, true);

        if ($menu->load(Yii::$app->request->post()) && $menu->save()) {
            return $this->redirect(['view', 'id' => $menu->restaurant_id]);
        }

        return $this->render('edit-menu', ['menu' => $menu, 'categories' => $categories]);
    }

    /**
     * Finds the Restaurant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Restaurant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    
}
