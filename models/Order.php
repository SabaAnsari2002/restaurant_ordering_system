<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;

class Order extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%order}}'; // Ensure the table name matches what you defined in the migration
    }

    // Define rules for validation
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
    // Define relationships, if any
    public function getRestaurant()
    {
        return $this->hasOne(Restaurant::class, ['id' => 'restaurant_id']);
    }
}
