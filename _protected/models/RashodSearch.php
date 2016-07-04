<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rashod;

/**
 * app\models\RashodSearch represents the model behind the search form about `app\models\Rashod`.
 */
 class RashodSearch extends Rashod
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'aktivnost_id'], 'integer'],
            [['iznos'], 'number'],
            [['datum', 'opis'], 'safe'],
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
        $query = Rashod::find();

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
            'aktivnost_id' => $this->aktivnost_id,
            'iznos' => $this->iznos,
            'datum' => $this->datum,
        ]);

        $query->andFilterWhere(['like', 'opis', $this->opis]);

        return $dataProvider;
    }
}
