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
            [['restaurant_id', 'name', 'description', 'price', 'category'], 'required'],
            [['restaurant_id'], 'integer'],
            [['price'], 'number'],
            [['description'], 'string'],
            [['name', 'category', 'photo'], 'string', 'max' => 255],
        ];
    }

    // Define the relation method
    public function getRestaurant()
    {
        return $this->hasOne(Restaurant::class, ['id' => 'restaurant_id']);
    }
}
