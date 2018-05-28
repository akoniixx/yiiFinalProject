<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TblStudio;

/**
 * TblStudioSearch represents the model behind the search form of `common\models\TblStudio`.
 */
class TblStudioSearch extends TblStudio
{
    /**
     * @inheritdoc
     */
    public $career;
    public $searchStudio;

    public function rules()
    {
        return [
            [['id', 'u_id'], 'integer'],
            [['url', 'studioName', 'tel', 'lineID', 'career', 'searchStudio'], 'safe'],
        ];
        /*, 'placeOfWork', 'workType', 'coverImg'*/
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
        $query = TblStudio::find();

        $query->joinWith(['categories']);

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
        /*$query->andFilterWhere([
            'id' => $this->id,
            'u_id' => $this->u_id,
        ]);*/

        $query->orFilterWhere(['like', 'url', $this->searchStudio])
            ->orFilterWhere(['like', 'studioName', $this->searchStudio])
            //->andFilterWhere(['like', 'email', $this->email])
            ->orFilterWhere(['like', 'tel', $this->searchStudio])
            ->orFilterWhere(['like', 'lineID', $this->searchStudio]);
            //->andFilterWhere(['like', 'placeOfWork', $this->placeOfWork])
            //->andFilterWhere(['like', 'workType', $this->workType])
            //->andFilterWhere(['like', 'coverImg', $this->coverImg]);

        return $dataProvider;
    }
}
