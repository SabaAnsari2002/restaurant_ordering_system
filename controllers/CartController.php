<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Menu;
use app\models\Cart;

class CartController extends Controller
{
    public function actionAddToCart($menuId)
    {
        $menu = Menu::findOne($menuId);

        if (!$menu || !$menu->isAvailable()) {
            Yii::$app->session->setFlash('error', 'This item is out of stock.');
            return $this->redirect(Yii::$app->request->referrer);
        }

        $cart = Cart::findOne(['user_id' => Yii::$app->user->id, 'menu_id' => $menuId]);

        if ($cart) {
            $cart->quantity += 1;
        } else {
            $cart = new Cart([
                'user_id' => Yii::$app->user->id,
                'restaurant_id' => $menu->restaurant_id,
                'menu_id' => $menuId,
                'quantity' => 1,
            ]);
        }

        if ($cart->save() && $menu->decrementStock()) {
            Yii::$app->session->setFlash('success', 'Item added to cart.');
        } else {
            Yii::$app->session->setFlash('error', 'Failed to add item to cart.');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionViewCart()
    {
        $cartItems = Cart::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->with(['menu', 'restaurant'])
            ->all();

        // Group by restaurant
        $groupedItems = [];
        foreach ($cartItems as $item) {
            $groupedItems[$item->restaurant->name][] = $item;
        }

        return $this->render('view-cart', ['groupedItems' => $groupedItems]);
    }

    public function actionUpdateCart($cartId, $quantity)
    {
        $cart = Cart::findOne(['id' => $cartId, 'user_id' => Yii::$app->user->id]);

        if (!$cart) {
            throw new \yii\web\NotFoundHttpException('Cart item not found.');
        }

        // If quantity is 0, remove the item
        if ($quantity == 0) {
            $cart->delete();
            Yii::$app->session->setFlash('success', 'Item removed from cart.');
        } else {
            $difference = $quantity - $cart->quantity;
            $menu = $cart->menu;

            if ($difference > 0 && !$menu->decrementStock($difference)) {
                Yii::$app->session->setFlash('error', 'Not enough stock available.');
                return $this->redirect(['view-cart']);
            }

            $cart->quantity = $quantity;

            if ($cart->save()) {
                Yii::$app->session->setFlash('success', 'Cart updated successfully.');
            } else {
                Yii::$app->session->setFlash('error', 'Failed to update cart.');
            }
        }

        return $this->redirect(['view-cart']);
    }
}
