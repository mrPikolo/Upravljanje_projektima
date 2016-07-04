<?php

namespace app\models;

use Yii;
use \app\models\base\VrstaUcesnika as BaseVrstaUcesnika;

/**
 * This is the model class for table "vrsta_ucesnika".
 */
class VrstaUcesnika extends BaseVrstaUcesnika
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['naziv'], 'string', 'max' => 45]
        ]);
    }
	
}
