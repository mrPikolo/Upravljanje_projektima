<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UcesnikRadiNaZadatku;

/**
 * app\models\UcesnikRadiNaZadatkuSearch represents the model behind the search form about `app\models\UcesnikRadiNaZadatku`.
 */
 class UcesnikRadiNaZadatkuSearch extends UcesnikRadiNaZadatku
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ucesnik_id', 'zadatak_id'], 'integer'],
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
        $query = UcesnikRadiNaZadatku::find();

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
            'ucesnik_id' => $this->ucesnik_id,
            'zadatak_id' => $this->zadatak_id,
        ]);

        return $dataProvider;
    }
}
