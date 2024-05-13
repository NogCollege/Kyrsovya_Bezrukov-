<?php

namespace app\models;

use yii\db\ActiveRecord;

class Texno extends ActiveRecord
{
    public function attributes()
    {
        return [
            'id',
            'nazvan',
            'categoria',
            'podcateg',
            'cena',
            'min_opis',
            'max_opis',
            'potrebenergi',
            'modeli',
            'garantia',
        ];
    }
    public static function tableName()
    {
        return 'TEXNO';
    }

}
