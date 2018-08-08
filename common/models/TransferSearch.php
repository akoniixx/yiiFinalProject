<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Transfer;

/**
 * TransferSearch represents the model behind the search form of `common\models\Transfer`.
 */
class TransferSearch extends Transfer
{
    /**
     * {@inheritdoc}
     */
    public $name;
    public $bank_from;
    public $transfer_time;
    public $bank_to;

    public function rules()
    {
        return [
            [['id', 'user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'bank_from', 'transfer_time', 'bank_to'], 'safe'],
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
    public function search($params, $id = null)
    {
        $query = Transfer::find();
        if (isset($id)) {
            $query->andWhere(['user_id' => $id]);
        }

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
            // 'id' => $this->id,
            'user_id' => $this->user_id,
            // 'status' => $this->status,
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
        ]);
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'bank_from', $this->bank_from])
            ->andFilterWhere(['like', 'transfer_time', $this->transfer_time])
            ->andFilterWhere(['like', 'bank_to', $this->bank_to]);

        return $dataProvider;
    }
}
