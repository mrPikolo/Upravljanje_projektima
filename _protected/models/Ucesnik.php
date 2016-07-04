<?php

namespace app\models;

use Yii;
use \app\models\base\Ucesnik as BaseUcesnik;

/**
 * This is the model class for table "ucesnik".
 */
class Ucesnik extends BaseUcesnik
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['user_id', 'vrsta_ucesnika_id', 'ime', 'prezime'], 'required'],
            [['user_id', 'vrsta_ucesnika_id'], 'integer'],
            [['ime', 'prezime'], 'string', 'max' => 60]
        ]);
    }
	
}
