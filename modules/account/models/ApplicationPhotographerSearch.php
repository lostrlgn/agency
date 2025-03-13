<?php

namespace app\modules\account\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ApplicationPhotographer;

/**
 * ApplicationPhotographerSearch represents the model behind the search form of `app\models\ApplicationPhotographer`.
 */
class ApplicationPhotographerSearch extends ApplicationPhotographer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status_reception_id', 'work_experience', 'user_id', 'payment', 'city_id', 'type_id'], 'integer'],
            [['comment_admin', 'description', 'portfolio_url'], 'safe'],
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
        $query = ApplicationPhotographer::find();

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
            'status_reception_id' => $this->status_reception_id,
            'work_experience' => $this->work_experience,
            'user_id' => $this->user_id,
            'payment' => $this->payment,
            'city_id' => $this->city_id,
            'type_id' => $this->type_id,
        ]);

        $query->andFilterWhere(['like', 'comment_admin', $this->comment_admin])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'portfolio_url', $this->portfolio_url]);

        return $dataProvider;
    }
}
