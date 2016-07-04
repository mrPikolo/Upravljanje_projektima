<?php

namespace app\models;

use Yii;
use \app\models\base\Prihod as BasePrihod;

/**
 * This is the model class for table "prihod".
 */
class Prihod extends BasePrihod
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['aktivnost_id', 'iznos', 'datum'], 'required'],
            [['aktivnost_id'], 'integer'],
            [['iznos'], 'number'],
            [['datum'], 'safe'],
            [['opis'], 'string', 'max' => 255]
        ]);
    }
	
}
