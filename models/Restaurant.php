<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Restaurant model
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $contact_number
 * @property int $user_id
 * @property int $created_at
 * @property int $updated_at
 */
class Restaurant extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%restaurant}}';
    }

    public function rules()
    {
        return [
            [['name', 'address', 'contact_number'], 'required'],
            [['user_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['address', 'contact_number'], 'string', 'max' => 255],
        ];
    }
}
