<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TblAlbum;

/**
 * TblAlbumSearch represents the model behind the search form of `common\models\TblAlbum`.
 */
class TblAlbumSearch extends TblAlbum
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['albumID', 'studioID'], 'integer'],
            [['albumName', 'type', 'image', 'create_time', 'update_time', 'status'], 'safe'],
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
    public function search($params, $id)
    {
        $query = TblAlbum::find();
        $query->where(['studioID' => $id]);

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
            'albumID' => $this->albumID,
            'studioID' => $this->studioID,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'albumName', $this->albumName])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
