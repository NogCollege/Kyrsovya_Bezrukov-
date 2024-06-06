<?php
// OrderForm.php
namespace app\models;

use yii\base\Model;

class OrderForm extends Model
{
    public $name;
    public $phone;
    public $address;

    public function rules()
    {
        return [
            [['name', 'phone', 'address'], 'required'],
            [['name', 'phone', 'address'], 'string', 'max' => 255],
        ];
    }
}
