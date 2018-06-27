<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GraduationSchedule;

/**
 * GraduationScheduleSearch represents the model behind the search form of `common\models\GraduationSchedule`.
 */
class GraduationScheduleSearch extends GraduationSchedule
{
    /**
     * {@inheritdoc}
     */
    public $dp_2;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['schedule', 'details', 'date'], 'safe'],
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
        $query = GraduationSchedule::find();
        $query->joinWith(['university']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=> SORT_DESC]],
            // 'pagination' => [ 'pageSize' => 5 ]
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
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'university.name', $this->schedule])
            ->andFilterWhere(['like', 'details', $this->details])
            ->andFilterWhere(['like', 'date', $this->date]);

        return $dataProvider;
    }
}
