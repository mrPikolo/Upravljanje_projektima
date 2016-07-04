<?php

namespace app\models;

use Yii;
use \app\models\base\Zadatak as BaseZadatak;

/**
 * This is the model class for table "zadatak".
 */
class Zadatak extends BaseZadatak
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['projekat_id', 'naziv', 'datum_pocetka', 'datum_zavrsetka'], 'required'],
            [['projekat_id'], 'integer'],
            [['covjek_casova', 'procenat_dovrsenosti'], 'number'],
            [['datum_pocetka', 'datum_zavrsetka'], 'safe'],
            [['opis'], 'string', 'max' => 255],
            [['naziv'], 'string', 'max' => 45]
        ]);
    }
	
}
