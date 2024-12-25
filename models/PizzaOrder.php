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
            // حذف قاعده مربوط به total_price
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // فقط تبدیل آرایه‌ها به رشته برای ذخیره‌سازی در دیتابیس
            if (is_array($this->bread_types)) {
                $this->bread_types = implode(',', $this->bread_types);
            }

            if (is_array($this->sausage_types)) {
                $this->sausage_types = implode(',', $this->sausage_types);
            }

            if (is_array($this->toppings)) {
                $this->toppings = implode(',', $this->toppings);
            }

            return true;
        }
        return false;
    }

    public function afterFind()
    {
        parent::afterFind();
        // تبدیل رشته‌ها به آرایه بعد از پیدا کردن رکورد
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
