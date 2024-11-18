<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Order extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%order}}'; // نام جدول باید با آنچه که در پایگاه داده ایجاد شده، مطابقت داشته باشد
    }

    public function rules()
    {
        return [
            [['phone_number', 'address', 'restaurant_id', 'status'], 'required'],
            [['customer_name', 'phone_number', 'status'], 'string', 'max' => 255],
            [['address'], 'string'],
            [['restaurant_id'], 'integer'],
            ['customer_name', 'default', 'value' => Yii::$app->user->identity->username],
        ];
    }

    // رابطه با مدل Restaurant
    public function getRestaurant()
    {
        return $this->hasOne(Restaurant::class, ['id' => 'restaurant_id']);
    }

    // رابطه با مدل OrderItem
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::class, ['order_id' => 'id']);
    }
    
}

