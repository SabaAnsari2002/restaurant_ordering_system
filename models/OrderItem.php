<?php

namespace app\models;

use yii\db\ActiveRecord;

class OrderItem extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%order_item}}';
    }

    public function rules()
    {
        return [
            [['order_id', 'menu_id', 'quantity', 'price'], 'required'],
            [['order_id', 'menu_id', 'quantity'], 'integer'],
            [['price'], 'number'],
        ];
    }

    // رابطه با مدل Order
    public function getOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }

    // رابطه با مدل Menu
    public function getMenu()
    {
        return $this->hasOne(Menu::class, ['id' => 'menu_id']);
    }
}
