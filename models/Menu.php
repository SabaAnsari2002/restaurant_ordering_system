<?php

namespace app\models;

use yii\db\ActiveRecord;

class Menu extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%menu}}';
    }

    public function rules()
    {
        return [
            [['restaurant_id', 'name', 'description', 'price', 'category', 'stock'], 'required'],
            [['restaurant_id', 'stock'], 'integer'],
            [['price'], 'number'],
            [['description'], 'string'],
            [['name', 'category', 'photo'], 'string', 'max' => 255],
        ];
    }

    public function decrementStock($quantity = 1)
    {
        if ($this->stock >= $quantity) {
            $this->stock -= $quantity;
            return $this->save();
        }
        return false;
    }

    public function isAvailable()
    {
        return $this->stock > 0;
    }

    public function getRestaurant()
    {
        return $this->hasOne(Restaurant::class, ['id' => 'restaurant_id']);
    }
}