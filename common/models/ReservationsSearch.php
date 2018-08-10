<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Reservations;

/**
 * ReservationsSearch represents the model behind the search form of `common\models\Reservations`.
 */
class ReservationsSearch extends Reservations
{
    /**
     * {@inheritdoc}
     */
    public $reservation_date;

    public function rules()
    {
        return [
            [['id', 'user_id', 'studio_id'], 'integer'],
            [['create_time', 'update_time', 'status', 'reservation_date'], 'safe'],
            // [['status'], 'string'],
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
    public function search($params, $id = null, $status = null)
    {
        $query = Reservations::find()
            ->innerJoinWith('reservationDetail', true);
        if (isset($id)) {
            $query->andWhere(['user_id' => $id]);
        }
        if (isset($status)) {
            $query->andWhere(['reservations.status' => Reservations::CONFIRM]);
        }
        // $query->innerJoinWith('reservationDetail', true);
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
            'studio_id' => $this->studio_id,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'status' => $this->status,
            'reservation_date' => $this->reservation_date,
        ]);

        return $dataProvider;
    }
}
