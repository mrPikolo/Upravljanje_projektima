<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Zadatak;

/**
 * app\models\ZadatakSearch represents the model behind the search form about `app\models\Zadatak`.
 */
 class ZadatakSearch extends Zadatak
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'projekat_id'], 'integer'],
            [['covjek_casova', 'procenat_dovrsenosti'], 'number'],
            [['opis', 'naziv', 'datum_pocetka', 'datum_zavrsetka'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Zadatak::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'projekat_id' => $this->projekat_id,
            'covjek_casova' => $this->covjek_casova,
            'procenat_dovrsenosti' => $this->procenat_dovrsenosti,
            'datum_pocetka' => $this->datum_pocetka,
            'datum_zavrsetka' => $this->datum_zavrsetka,
        ]);

        $query->andFilterWhere(['like', 'opis', $this->opis])
            ->andFilterWhere(['like', 'naziv', $this->naziv]);

        return $dataProvider;
    }
}
