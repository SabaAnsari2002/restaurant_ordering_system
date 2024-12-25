<?php
namespace app\models;

use yii\db\ActiveRecord;

class MenuItems extends ActiveRecord
{
    public static function tableName()
    {
        return 'menu_items';
    }

    public function rules()
    {
        return [
            [['item_name', 'item_type', 'price'], 'required'],
            [['price'], 'number'],
            [['item_name', 'item_type'], 'string', 'max' => 255],
        ];
    }

    // Relationship with Restaurant (if needed)
    public function getRestaurant()
    {
        return $this->belongsTo(Restaurant::className(), ['restaurant_id' => 'id']);
    }
}
