<?php

namespace app\models;

use yii\db\ActiveRecord;

class Order extends ActiveRecord
{
    public static function tableName()
    {
        return 'orders';
    }

    public function rules()
    {
        return [
            [['user_id', 'name', 'phone', 'address', 'total', 'created_at'], 'required'],
            [['user_id'], 'integer'],
            [['total'], 'number'],
            [['created_at'], 'safe'],
            [['name', 'phone', 'address'], 'string', 'max' => 255],
        ];
    }
}
