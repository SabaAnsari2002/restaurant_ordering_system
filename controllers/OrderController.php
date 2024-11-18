<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Order;
use yii\web\NotFoundHttpException;

class OrderController extends Controller
{

    public function actionChangeStatus($orderId)
    {
        $order = Order::findOne($orderId);
        if (!$order) {
            throw new NotFoundHttpException('Order not found.');
        }

        // Update the order status to "sent"
        $order->status = 'sent';

        if ($order->save()) {
            // Notify the customer that their order is being sent
            Yii::$app->session->setFlash('success', 'Order status updated to "Sent" and customer notified.');
            
            // Send notification to the customer (e.g., email or SMS)
            $this->sendOrderUpdateNotification($order);

        } else {
            Yii::$app->session->setFlash('error', 'Failed to update order status.');
        }

        return $this->redirect(['view-order', 'orderId' => $orderId]);
    }

    private function sendOrderUpdateNotification($order)
    {
        // Send an email or SMS notification to the customer
        // For simplicity, we're sending an email here
        Yii::$app->mailer->compose()
            ->setFrom('restaurant@example.com')
            ->setTo($order->customer_email)
            ->setSubject('Your Order is Being Sent')
            ->setTextBody("Dear {$order->customer_name},\n\nYour order (ID: {$order->id}) is being sent. Thank you for ordering with us!")
            ->send();
    }
    public function actionUpdateStatus($orderId, $status)
{
    $order = Order::findOne($orderId);

    if (!$order) {
        Yii::$app->session->setFlash('error', 'Order not found.');
        return $this->redirect(['view-orders']);
    }

    // Update order status
    $order->status = $status;
    if ($order->save()) {
        Yii::$app->session->setFlash('success', 'Order status updated successfully.');

      
    } else {
        Yii::$app->session->setFlash('error', 'Failed to update the order status.');
    }

    return $this->redirect(['view-orders']);
}

}
