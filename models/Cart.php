<?php
namespace app\models;

use yii\db\ActiveRecord;

class Cart extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%cart}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'restaurant_id', 'menu_id', 'quantity'], 'required'],
            [['user_id', 'restaurant_id', 'menu_id', 'quantity'], 'integer'],
            [['quantity'], 'integer', 'min' => 1], // Ensure at least one item
        ];
    }

    public function getMenu()
    {
        return $this->hasOne(Menu::class, ['id' => 'menu_id']);
    }

    public function getRestaurant()
    {
        return $this->hasOne(Restaurant::class, ['id' => 'restaurant_id']);
    }
}
