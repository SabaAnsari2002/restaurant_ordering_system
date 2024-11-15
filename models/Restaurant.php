<?php
namespace app\models;

use yii\db\ActiveRecord;

class Restaurant extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%restaurant}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'name', 'contact_number', 'address', 'categories'], 'required'],
            [['user_id'], 'integer'],
            [['categories'], 'string'],
            [['name', 'contact_number', 'address'], 'string', 'max' => 255],
        ];
    }

    public function getMenus()
    {
        return $this->hasMany(Menu::class, ['restaurant_id' => 'id']);
    }
}
