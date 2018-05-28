<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\VerifyMember;
//use common\models\VerifyStatus;

/**
 * VerifyMemberSearch represents the model behind the search form of `common\models\VerifyMember`.
 */
class VerifyMemberSearch extends VerifyMember
{
    /**
     * @inheritdoc
     */
    public $status_id;

    public function rules()
    {
        return [
            [['verify_id', 'studio_id'], 'integer'],
            [['img_idCard', 'img_profile', 'fname', 'lname', 'tel', 'created_at', 'verify_status', 'status_id'], 'safe'],
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
        $query = VerifyMember::find();

        //$query->joinWith('verify_status', true);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['verify_id' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'verify_id' => $this->verify_id,
            'studio_id' => $this->studio_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'img_idCard', $this->img_idCard])
            ->andFilterWhere(['like', 'img_profile', $this->img_profile])
            ->andFilterWhere(['like', 'fname', $this->fname])
            ->andFilterWhere(['like', 'lname', $this->lname])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'verify_status', $this->verify_status]);

        return $dataProvider;
    }
}
