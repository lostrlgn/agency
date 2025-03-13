<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Photographer;

/**
 * PhotographerSearch represents the model behind the search form of `app\models\Photographer`.
 */
class PhotographerSearch extends Photographer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'payment', 'position_id', 'city_id'], 'integer'],
            [['portfolio_url', 'description'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Photographer::find()
        ->with(['user', 'city']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'payment' => $this->payment,
            'position_id' => $this->position_id,
            'city_id' => $this->city_id,
        ]);

        $query->andFilterWhere(['like', 'portfolio_url', $this->portfolio_url])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
