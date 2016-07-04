<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "aktivnost".
 *
 * @property integer $id
 * @property integer $ucesnik_id
 * @property integer $zadatak_id
 * @property string $naziv
 * @property string $opis
 * @property integer $utroseno_vrijeme
 *
 * @property \app\models\Ucesnik $ucesnik
 * @property \app\models\Zadatak $zadatak
 * @property \app\models\Prihod[] $prihods
 * @property \app\models\Rashod[] $rashods
 */
class Aktivnost extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ucesnik_id', 'zadatak_id', 'naziv'], 'required'],
            [['ucesnik_id', 'zadatak_id', 'utroseno_vrijeme'], 'integer'],
            [['naziv'], 'string', 'max' => 45],
            [['opis'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aktivnost';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ucesnik_id' => 'Ucesnik ID',
            'zadatak_id' => 'Zadatak ID',
            'naziv' => 'Naziv',
            'opis' => 'Opis',
            'utroseno_vrijeme' => 'Utroseno Vrijeme',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUcesnik()
    {
        return $this->hasOne(\app\models\Ucesnik::className(), ['id' => 'ucesnik_id']);
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
    public function getPrihods()
    {
        return $this->hasMany(\app\models\Prihod::className(), ['aktivnost_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRashods()
    {
        return $this->hasMany(\app\models\Rashod::className(), ['aktivnost_id' => 'id']);
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
     * @return \app\models\AktivnostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\AktivnostQuery(get_called_class());
    }
}
