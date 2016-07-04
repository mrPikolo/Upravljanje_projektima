<?php

namespace app\models;

use Yii;
use \app\models\base\Projekat as BaseProjekat;

/**
 * This is the model class for table "projekat".
 */
class Projekat extends BaseProjekat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['naziv', 'datum_pocetka', 'datum_zavrsetka', 'budzet'], 'required'],
            [['datum_pocetka', 'datum_zavrsetka', 'krajnji_rok'], 'safe'],
            [['budzet'], 'number'],
            [['aktivan'], 'integer'],
            [['naziv'], 'string', 'max' => 45],
            [['opis'], 'string', 'max' => 255]
        ]);
    }
	
}
