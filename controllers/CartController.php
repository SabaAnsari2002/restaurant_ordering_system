<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Menu;
use app\models\Cart;
use app\models\Order;
use app\models\OrderItem;

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
    public function actionPlaceOrder($restaurantId)
{
    $order = new Order();
    $order->restaurant_id = $restaurantId;
    $order->status = 'pending';
    $order->customer_name = Yii::$app->user->identity->username; // Set the customer name from the logged-in user

    if ($order->load(Yii::$app->request->post())) {
        // Store order data in session
        Yii::$app->session->set('pendingOrder', $order->attributes);
        return $this->redirect(['order-summary', 'restaurantId' => $restaurantId]);
    }

    return $this->render('place-order', [
        'order' => $order,
        'restaurantId' => $restaurantId,
    ]);
}

    public function actionOrderSummary($restaurantId)
    {
        $pendingOrder = Yii::$app->session->get('pendingOrder');
        if (!$pendingOrder) {
            return $this->redirect(['place-order', 'restaurantId' => $restaurantId]);
        }

        $cartItems = Cart::find()
            ->where(['user_id' => Yii::$app->user->id, 'restaurant_id' => $restaurantId])
            ->with(['menu'])
            ->all();

        $totalPrice = array_reduce($cartItems, function($carry, $item) {
            return $carry + ($item->quantity * $item->menu->price);
        }, 0);

        $restaurant = \app\models\Restaurant::findOne($restaurantId);

        return $this->render('order-summary', [
            'pendingOrder' => $pendingOrder,
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
            'restaurant' => $restaurant,
        ]);
    }
    public function actionConfirmOrder()
    {
        $pendingOrder = Yii::$app->session->get('pendingOrder');
        if (!$pendingOrder) {
            return $this->redirect(['view-cart']);
        }
    
        $order = new Order($pendingOrder);
        
        if ($order->save()) {
            $cartItems = Cart::find()
                ->where(['user_id' => Yii::$app->user->id, 'restaurant_id' => $order->restaurant_id])
                ->all();
    
            $restaurant = \app\models\Restaurant::findOne($order->restaurant_id);
            
            foreach ($cartItems as $cartItem) {
                $orderItem = new OrderItem([
                    'order_id' => $order->id,
                    'menu_id' => $cartItem->menu_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->menu->price,
                ]);
                $orderItem->save();
                $cartItem->delete();
            }
    
            // Store the restaurant name in the session
            Yii::$app->session->set('lastOrderRestaurant', $restaurant->name);
    
            Yii::$app->session->remove('pendingOrder');
            Yii::$app->session->setFlash('success', 'Order placed successfully!');
            return $this->redirect(['view-cart']);
        } else {
            Yii::$app->session->setFlash('error', 'Failed to place order. Please try again.');
            return $this->redirect(['order-summary', 'restaurantId' => $order->restaurant_id]);
        }
    }
    
    
    public function actionFinalizeOrder($orderId)
{
    $order = Order::findOne($orderId);

    if (!$order) {
        throw new NotFoundHttpException('Order not found.');
    }

    // Mark the order as finalized (you can add more logic here if needed)
    $order->status = 'finalized';
    if ($order->save()) {
        Yii::$app->session->setFlash('success', 'Order has been finalized!');
        return $this->redirect(['cart/view-cart']);
    } else {
        Yii::$app->session->setFlash('error', 'Failed to finalize the order.');
        return $this->redirect(['cart/view-cart']);
    }
}

public function actionUpdateQuantity($cartId, $change)
{
    $cart = Cart::findOne(['id' => $cartId, 'user_id' => Yii::$app->user->id]);

    if (!$cart) {
        throw new \yii\web\NotFoundHttpException('Cart item not found.');
    }

    $newQuantity = $cart->quantity + $change;

    if ($newQuantity <= 0) {
        // Remove the item if quantity reaches zero or below
        $cart->delete();
        Yii::$app->session->setFlash('success', 'Item removed from cart.');
    } else {
        $menu = $cart->menu;

        if ($change > 0 && !$menu->decrementStock($change)) {
            Yii::$app->session->setFlash('error', 'Not enough stock available.');
        } else {
            $cart->quantity = $newQuantity;
            if ($cart->save()) {
                Yii::$app->session->setFlash('success', 'Cart updated successfully.');
            } else {
                Yii::$app->session->setFlash('error', 'Failed to update cart.');
            }
        }
    }

    return $this->redirect(['view-cart']);
}
public function actionViewCart()
{
    $cartItems = Cart::find()
        ->where(['user_id' => Yii::$app->user->id])
        ->with(['menu', 'restaurant'])
        ->all();

    // Group by restaurant
    $groupedItems = [];
    $totalPrices = [];
    foreach ($cartItems as $item) {
        $groupedItems[$item->restaurant->name][] = $item;
        if (!isset($totalPrices[$item->restaurant->name])) {
            $totalPrices[$item->restaurant->name] = 0;
        }
        $totalPrices[$item->restaurant->name] += $item->menu->price * $item->quantity;
    }

    $lastOrderRestaurant = Yii::$app->session->get('lastOrderRestaurant');

    return $this->render('view-cart', [
        'groupedItems' => $groupedItems,
        'totalPrices' => $totalPrices,
        'lastOrderRestaurant' => $lastOrderRestaurant,
    ]);
}


}
