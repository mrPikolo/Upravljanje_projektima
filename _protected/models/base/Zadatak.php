<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "zadatak".
 *
 * @property integer $id
 * @property integer $projekat_id
 * @property string $covjek_casova
 * @property string $procenat_dovrsenosti
 * @property string $opis
 * @property string $naziv
 * @property string $datum_pocetka
 * @property string $datum_zavrsetka
 *
 * @property \app\models\Aktivnost[] $aktivnosts
 * @property \app\models\UcesnikRadiNaZadatku[] $ucesnikRadiNaZadatkus
 * @property \app\models\Ucesnik[] $ucesniks
 * @property \app\models\Projekat $projekat
 */
class Zadatak extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['projekat_id', 'naziv', 'datum_pocetka', 'datum_zavrsetka'], 'required'],
            [['projekat_id'], 'integer'],
            [['covjek_casova', 'procenat_dovrsenosti'], 'number'],
            [['datum_pocetka', 'datum_zavrsetka'], 'safe'],
            [['opis'], 'string', 'max' => 255],
            [['naziv'], 'string', 'max' => 45]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zadatak';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'projekat_id' => 'Projekat ID',
            'covjek_casova' => 'Covjek Casova',
            'procenat_dovrsenosti' => 'Procenat Dovrsenosti',
            'opis' => 'Opis',
            'naziv' => 'Naziv',
            'datum_pocetka' => 'Datum Pocetka',
            'datum_zavrsetka' => 'Datum Zavrsetka',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktivnosts()
    {
        return $this->hasMany(\app\models\Aktivnost::className(), ['zadatak_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUcesnikRadiNaZadatkus()
    {
        return $this->hasMany(\app\models\UcesnikRadiNaZadatku::className(), ['zadatak_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUcesniks()
    {
        return $this->hasMany(\app\models\Ucesnik::className(), ['id' => 'ucesnik_id'])->viaTable('ucesnik_radi_na_zadatku', ['zadatak_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjekat()
    {
        return $this->hasOne(\app\models\Projekat::className(), ['id' => 'projekat_id']);
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
     * @return \app\models\ZadatakQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ZadatakQuery(get_called_class());
    }
}
