<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class PizzaOrder extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%pizza_order}}';
    }

    public function rules()
{
    return [
        [['bread_types', 'sausage_types', 'toppings', 'restaurant_id'], 'required'],
        [['bread_types', 'sausage_types', 'toppings'], 'safe'],
        [['restaurant_id'], 'integer'],
        [['total_price'], 'number'],
    ];
}


    public function beforeSave($insert)
{
    if (parent::beforeSave($insert)) {
        $prices = [
            'Neapolitan Crust' => 5,
            'Thin Crust' => 4,
            'Thick Crust' => 6,
            'New York Style' => 7,
            'Chicago Deep Dish' => 8,
            'Pepperoni' => 3,
            'Salami' => 4,
            'Italian Sausage' => 5,
            'Ham' => 3.5,
            'Capicola' => 4.5,
            'Mozzarella Cheese' => 2,
            'Cheddar Cheese' => 2.5,
            'Parmesan Cheese' => 3,
            'Ricotta Cheese' => 2,
            'Mushrooms' => 1.5,
            'Olives' => 1.5,
            'Bell Peppers' => 1,
            'Onions' => 1,
            'Fresh Basil' => 0.5,
            'Fresh Tomatoes' => 1,
            'Spinach' => 1,
            'Corn' => 1,
            'Garlic' => 0.5,
            'Thyme' => 0.5,
            'Red Chili Flakes' => 0.5,
            'Paprika Powder' => 0.5,
        ];

        $this->total_price = 0;

        if (is_array($this->bread_types)) {
            foreach ($this->bread_types as $item) {
                $this->total_price += $prices[$item] ?? 0;
            }
            $this->bread_types = implode(',', $this->bread_types);
        }

        if (is_array($this->sausage_types)) {
            foreach ($this->sausage_types as $item) {
                $this->total_price += $prices[$item] ?? 0;
            }
            $this->sausage_types = implode(',', $this->sausage_types);
        }

        if (is_array($this->toppings)) {
            foreach ($this->toppings as $item) {
                $this->total_price += $prices[$item] ?? 0;
            }
            $this->toppings = implode(',', $this->toppings);
        }

        return true;
    }
    return false;
}


    public function afterFind()
    {
        parent::afterFind();
        $this->bread_types = explode(',', $this->bread_types);
        $this->sausage_types = explode(',', $this->sausage_types);
        $this->toppings = explode(',', $this->toppings);
    }

    public static function deleteExistingOrder($restaurant_id)
    {
        self::deleteAll(['restaurant_id' => $restaurant_id]);
    }

    public function getRestaurant()
    {
        return $this->hasOne(Restaurant::class, ['id' => 'restaurant_id']);
    }
    
}
