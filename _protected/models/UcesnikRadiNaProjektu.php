<?php

namespace app\models;

use Yii;
use \app\models\base\UcesnikRadiNaProjektu as BaseUcesnikRadiNaProjektu;

/**
 * This is the model class for table "ucesnik_radi_na_projektu".
 */
class UcesnikRadiNaProjektu extends BaseUcesnikRadiNaProjektu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['ucesnik_id', 'projekat_id'], 'required'],
            [['ucesnik_id', 'projekat_id'], 'integer']
        ]);
    }
	
}
