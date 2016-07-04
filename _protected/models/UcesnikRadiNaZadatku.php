<?php

namespace app\models;

use Yii;
use \app\models\base\UcesnikRadiNaZadatku as BaseUcesnikRadiNaZadatku;

/**
 * This is the model class for table "ucesnik_radi_na_zadatku".
 */
class UcesnikRadiNaZadatku extends BaseUcesnikRadiNaZadatku
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['ucesnik_id', 'zadatak_id'], 'required'],
            [['ucesnik_id', 'zadatak_id'], 'integer']
        ]);
    }
	
}
