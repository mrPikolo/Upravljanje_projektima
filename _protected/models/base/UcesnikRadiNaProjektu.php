<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "ucesnik_radi_na_projektu".
 *
 * @property integer $ucesnik_id
 * @property integer $projekat_id
 *
 * @property \app\models\Projekat $projekat
 * @property \app\models\Ucesnik $ucesnik
 */
class UcesnikRadiNaProjektu extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ucesnik_id', 'projekat_id'], 'required'],
            [['ucesnik_id', 'projekat_id'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ucesnik_radi_na_projektu';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ucesnik_id' => 'Ucesnik ID',
            'projekat_id' => 'Projekat ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjekat()
    {
        return $this->hasOne(\app\models\Projekat::className(), ['id' => 'projekat_id']);
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
     * @return \app\models\UcesnikRadiNaProjektuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\UcesnikRadiNaProjektuQuery(get_called_class());
    }
}
