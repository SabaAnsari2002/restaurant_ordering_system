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
            [['bread_types', 'sausage_types', 'toppings'], 'required'],
            [['bread_types', 'sausage_types', 'toppings'], 'string'],
        ];
    }

    // ذخیره داده‌ها به فرمت سریالی
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // تبدیل آرایه به رشته برای ذخیره در دیتابیس
            if (is_array($this->bread_types)) {
                $this->bread_types = implode(',', $this->bread_types); // برای نان‌ها
            }
            if (is_array($this->sausage_types)) {
                $this->sausage_types = implode(',', $this->sausage_types); // برای سوسیس‌ها
            }
            if (is_array($this->toppings)) {
                $this->toppings = implode(',', $this->toppings); // برای تاپینگ‌ها
            }

            return true;
        }
        return false;
    }

    // تبدیل داده‌ها از فرمت سریالی به آرایه
    public function getBreadTypes()
    {
        return explode(',', $this->bread_types);
    }

    public function getSausageTypes()
    {
        return explode(',', $this->sausage_types);
    }

    public function getToppings()
    {
        return explode(',', $this->toppings);
    }
}
