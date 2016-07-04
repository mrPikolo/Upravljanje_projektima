<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "ucesnik_radi_na_zadatku".
 *
 * @property integer $ucesnik_id
 * @property integer $zadatak_id
 *
 * @property \app\models\Zadatak $zadatak
 * @property \app\models\Ucesnik $ucesnik
 */
class UcesnikRadiNaZadatku extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ucesnik_id', 'zadatak_id'], 'required'],
            [['ucesnik_id', 'zadatak_id'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ucesnik_radi_na_zadatku';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ucesnik_id' => 'Ucesnik ID',
            'zadatak_id' => 'Zadatak ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZadatak()
    {
        return $this->hasOne(\app\models\Zadatak::className(), ['id' => 'zadatak_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUcesnik()
    {
        return $this->hasOne(\app\models\Ucesnik::className(), ['id' => 'ucesnik_id']);
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
     * @return \app\models\UcesnikRadiNaZadatkuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\UcesnikRadiNaZadatkuQuery(get_called_class());
    }
}
