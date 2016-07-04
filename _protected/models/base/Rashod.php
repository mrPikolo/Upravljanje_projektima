<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "rashod".
 *
 * @property integer $id
 * @property integer $aktivnost_id
 * @property string $iznos
 * @property string $datum
 * @property string $opis
 *
 * @property \app\models\Aktivnost $aktivnost
 */
class Rashod extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aktivnost_id', 'iznos', 'datum'], 'required'],
            [['aktivnost_id'], 'integer'],
            [['iznos'], 'number'],
            [['datum'], 'safe'],
            [['opis'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rashod';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'aktivnost_id' => 'Aktivnost ID',
            'iznos' => 'Iznos',
            'datum' => 'Datum',
            'opis' => 'Opis',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktivnost()
    {
        return $this->hasOne(\app\models\Aktivnost::className(), ['id' => 'aktivnost_id']);
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
     * @return \app\models\RashodQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\RashodQuery(get_called_class());
    }
}
