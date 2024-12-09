<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Restaurant;
use app\models\Menu;
use app\models\PizzaOrder;

class MenuController extends Controller
{
    public function actionIndex()
    {
        // Fetch distinct categories from the database
        $categories = Menu::find()->select('category')->distinct()->asArray()->all();

        // Fetch all restaurants
        $restaurants = Restaurant::find()->all();

        return $this->render('index', [
            'categories' => $categories,
            'restaurants' => $restaurants,
        ]);
    }

    public function actionCategory($category)
    {
        // Find restaurants offering food in the given category
        $restaurants = Restaurant::find()
            ->joinWith('menus')
            ->where(['menu.category' => $category])
            ->all();

        return $this->render('category', [
            'category' => $category,
            'restaurants' => $restaurants,
        ]);
    }
    public function actionRestaurant($id)
{
    $restaurant = Restaurant::findOne($id);
    if (!$restaurant) {
        throw new \yii\web\NotFoundHttpException('Restaurant not found.');
    }

    // Fetch menus grouped by category
    $menus = $restaurant->getMenus()->asArray()->all();
    $menusByCategory = [];
    
    foreach ($menus as $menu) {
        $menusByCategory[$menu['category']][] = $menu;
    }

    // Check if restaurant has pizza orders
    $hasPizzaOrder = PizzaOrder::find()->where(['restaurant_id' => $id])->exists();

    return $this->render('restaurant', [
        'restaurant' => $restaurant,
        'menusByCategory' => $menusByCategory,
        'hasPizzaOrder' => $hasPizzaOrder, // Pass to view
    ]);
}

    
}
