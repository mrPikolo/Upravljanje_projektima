<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "projekat".
 *
 * @property integer $id
 * @property string $naziv
 * @property string $opis
 * @property string $datum_pocetka
 * @property string $datum_zavrsetka
 * @property string $krajnji_rok
 * @property string $budzet
 * @property integer $aktivan
 *
 * @property \app\models\UcesnikRadiNaProjektu[] $ucesnikRadiNaProjektus
 * @property \app\models\Ucesnik[] $ucesniks
 * @property \app\models\Zadatak[] $zadataks
 */
class Projekat extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['naziv', 'datum_pocetka', 'datum_zavrsetka', 'budzet'], 'required'],
            [['datum_pocetka', 'datum_zavrsetka', 'krajnji_rok'], 'safe'],
            [['budzet'], 'number'],
            [['aktivan'], 'integer'],
            [['naziv'], 'string', 'max' => 45],
            [['opis'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projekat';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'naziv' => 'Naziv',
            'opis' => 'Opis',
            'datum_pocetka' => 'Datum Pocetka',
            'datum_zavrsetka' => 'Datum Zavrsetka',
            'krajnji_rok' => 'Krajnji Rok',
            'budzet' => 'Budzet',
            'aktivan' => 'Aktivan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUcesnikRadiNaProjektus()
    {
        return $this->hasMany(\app\models\UcesnikRadiNaProjektu::className(), ['projekat_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUcesniks()
    {
        return $this->hasMany(\app\models\Ucesnik::className(), ['id' => 'ucesnik_id'])->viaTable('ucesnik_radi_na_projektu', ['projekat_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZadataks()
    {
        return $this->hasMany(\app\models\Zadatak::className(), ['projekat_id' => 'id']);
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
     * @return \app\models\ProjekatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ProjekatQuery(get_called_class());
    }
}
