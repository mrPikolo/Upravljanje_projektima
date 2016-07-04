<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "vrsta_ucesnika".
 *
 * @property integer $id
 * @property string $naziv
 *
 * @property \app\models\Ucesnik[] $ucesniks
 */
class VrstaUcesnika extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['naziv'], 'string', 'max' => 45]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vrsta_ucesnika';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'naziv' => 'Naziv',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUcesniks()
    {
        return $this->hasMany(\app\models\Ucesnik::className(), ['vrsta_ucesnika_id' => 'id']);
    }

/**
     * @inheritdoc
     * @return type mixed
     */ 
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\VrstaUcesnikaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\VrstaUcesnikaQuery(get_called_class());
    }
}
