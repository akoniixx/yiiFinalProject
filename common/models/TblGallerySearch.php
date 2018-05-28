<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TblGallery;

/**
 * TblGallerySearch represents the model behind the search form of `common\models\TblGallery`.
 */
class TblGallerySearch extends TblGallery
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gID', 'aID'], 'integer'],
            [['gName', 'gimages', 'date', 'status'], 'safe'],
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
        $query = TblGallery::find()->select('*')->where(['aID' => $params]);

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
            'gID' => $this->gID,
            'aID' => $this->aID,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'gName', $this->gName])
            ->andFilterWhere(['like', 'gimages', $this->gimages])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
