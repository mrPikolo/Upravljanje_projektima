<?php

namespace app\models;

use Yii;
use \app\models\base\Aktivnost as BaseAktivnost;

/**
 * This is the model class for table "aktivnost".
 */
class Aktivnost extends BaseAktivnost
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['ucesnik_id', 'zadatak_id', 'naziv'], 'required'],
            [['ucesnik_id', 'zadatak_id', 'utroseno_vrijeme'], 'integer'],
            [['naziv'], 'string', 'max' => 45],
            [['opis'], 'string', 'max' => 255]
        ]);
    }
	
}
