<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UProfile;

/**
 * UProfileSearch represents the model behind the search form of `common\models\UProfile`.
 */
class UProfileSearch extends UProfile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'u_id'], 'integer'],
            [['firstName', 'lastName', 'tel', 'userType', 'email', 'imgProfile'], 'safe'],
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
        $query = UProfile::find();

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
            'u_id' => $this->u_id,
        ]);

        $query->andFilterWhere(['like', 'firstName', $this->firstName])
            ->andFilterWhere(['like', 'lastName', $this->lastName])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'userType', $this->userType])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'imgProfile', $this->imgProfile]);

        return $dataProvider;
    }
}
