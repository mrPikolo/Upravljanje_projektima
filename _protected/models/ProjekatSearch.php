<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Projekat;

/**
 * app\models\ProjekatSearch represents the model behind the search form about `app\models\Projekat`.
 */
 class ProjekatSearch extends Projekat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'aktivan'], 'integer'],
            [['naziv', 'opis', 'datum_pocetka', 'datum_zavrsetka', 'krajnji_rok'], 'safe'],
            [['budzet'], 'number'],
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
        $query = Projekat::find();

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
            'datum_pocetka' => $this->datum_pocetka,
            'datum_zavrsetka' => $this->datum_zavrsetka,
            'krajnji_rok' => $this->krajnji_rok,
            'budzet' => $this->budzet,
            'aktivan' => $this->aktivan,
        ]);

        $query->andFilterWhere(['like', 'naziv', $this->naziv])
            ->andFilterWhere(['like', 'opis', $this->opis]);

        return $dataProvider;
    }
}
