<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Texno extends ActiveRecord
{
    public static function tableName()
    {
        return 'texno';
    }

    public function rules()
    {
        return [
            [['nazvan', 'cena', 'min_opis','max_opis', 'img_url', 'categoria', 'podcateg','potrebenergi','modeli','garantia'], 'required'],
            [['cena'], 'number'],
            [['min_opis'], 'string'],
            [['max_opis'], 'string'],
            [['nazvan', 'img_url', 'categoria', 'podcateg','potrebenergi','modeli','garantia'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nazvan' => 'Название',
            'cena' => 'Цена',
            'min_opis' => 'Минимальное Описание',
            'max_opis' => 'Максимальное Описание',
            'img_url' => 'URL изображения',
            'categoria' => 'Категория',
            'podcateg' => 'Подкатегория',
            'potrebenergi' => 'Потребление энергии',
            'modeli' => 'Модель',
            'garantia' => 'Гаранития',
        ];
    }
}

