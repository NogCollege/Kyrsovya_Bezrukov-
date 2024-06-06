<?php

// Order.php
// models/Order.php
// models/Order.php
// models/Order.php
namespace app\models;

use yii\db\ActiveRecord;

class Order extends ActiveRecord
{
    const STATUS_PENDING = 'Pending';
    const STATUS_IN_PROGRESS = 'Принять в работу';
    const STATUS_REJECTED = 'Отклонить';
    const STATUS_COMPLETED = 'Завершить';

    public static function tableName()
    {
        return 'orders';
    }

    public function rules()
    {
        return [
            [['user_id', 'name', 'phone', 'address', 'items', 'total', 'created_at', 'status'], 'required'],
            [['user_id', 'created_at'], 'integer'],
            [['items'], 'string'],
            [['total'], 'number'],
            [['name', 'phone', 'address', 'status'], 'string', 'max' => 255],
            ['status', 'in', 'range' => [self::STATUS_PENDING, self::STATUS_IN_PROGRESS, self::STATUS_REJECTED, self::STATUS_COMPLETED]],
        ];
    }
}


