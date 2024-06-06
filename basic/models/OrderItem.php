<?php

namespace app\models;

use yii\db\ActiveRecord;

class OrderItem extends ActiveRecord
{
    public static function tableName()
    {
        return 'order_items';
    }

    public function rules()
    {
        return [
            [['order_id', 'product_id', 'product_name', 'price', 'quantity'], 'required'],
            [['order_id', 'product_id', 'quantity'], 'integer'],
            [['price'], 'number'],
            [['product_name'], 'string', 'max' => 255],
        ];
    }

    public function getOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Texno::class, ['id' => 'product_id']);
    }
}
