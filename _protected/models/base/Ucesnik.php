<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "ucesnik".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $vrsta_ucesnika_id
 * @property string $ime
 * @property string $prezime
 *
 * @property \app\models\Aktivnost[] $aktivnosts
 * @property \app\models\User $user
 * @property \app\models\VrstaUcesnika $vrstaUcesnika
 * @property \app\models\UcesnikRadiNaProjektu[] $ucesnikRadiNaProjektus
 * @property \app\models\Projekat[] $projekats
 * @property \app\models\UcesnikRadiNaZadatku[] $ucesnikRadiNaZadatkus
 * @property \app\models\Zadatak[] $zadataks
 */
class Ucesnik extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'vrsta_ucesnika_id', 'ime', 'prezime'], 'required'],
            [['user_id', 'vrsta_ucesnika_id'], 'integer'],
            [['ime', 'prezime'], 'string', 'max' => 60]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ucesnik';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'vrsta_ucesnika_id' => 'Vrsta Ucesnika ID',
            'ime' => 'Ime',
            'prezime' => 'Prezime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktivnosts()
    {
        return $this->hasMany(\app\models\Aktivnost::className(), ['ucesnik_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVrstaUcesnika()
    {
        return $this->hasOne(\app\models\VrstaUcesnika::className(), ['id' => 'vrsta_ucesnika_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUcesnikRadiNaProjektus()
    {
        return $this->hasMany(\app\models\UcesnikRadiNaProjektu::className(), ['ucesnik_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjekats()
    {
        return $this->hasMany(\app\models\Projekat::className(), ['id' => 'projekat_id'])->viaTable('ucesnik_radi_na_projektu', ['ucesnik_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUcesnikRadiNaZadatkus()
    {
        return $this->hasMany(\app\models\UcesnikRadiNaZadatku::className(), ['ucesnik_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZadataks()
    {
        return $this->hasMany(\app\models\Zadatak::className(), ['id' => 'zadatak_id'])->viaTable('ucesnik_radi_na_zadatku', ['ucesnik_id' => 'id']);
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
     * @return \app\models\UcesnikQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\UcesnikQuery(get_called_class());
    }
}
