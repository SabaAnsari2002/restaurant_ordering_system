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
            [['bread_types', 'sausage_types', 'toppings'], 'safe'], // آرایه را به عنوان داده‌های امن قبول کنید
        ];
    }

    // ذخیره داده‌ها به فرمت سریالی
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
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

    // تبدیل داده‌ها از فرمت سریالی به آرایه
    public function afterFind()
    {
        parent::afterFind();
        $this->bread_types = explode(',', $this->bread_types);
        $this->sausage_types = explode(',', $this->sausage_types);
        $this->toppings = explode(',', $this->toppings);
    }
}
