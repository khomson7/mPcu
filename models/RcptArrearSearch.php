<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RcptArrear;

/**
 * RcptArrearSearch represents the model behind the search form of `app\models\RcptArrear`.
 */
class RcptArrearSearch extends RcptArrear {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['arrear_id'], 'integer'],
                [['vn', 'arrear_date', 'arrear_time', 'staff', 'rcpno', 'finance_number', 'paid', 'pt_type', 'hn', 'receive_money_date', 'receive_money_time', 'receive_money_staff', 'hos_guid', 'an'], 'safe'],
                [['amount'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
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
    public function search($params) {
        $re = ('30');
        $re2 = ('N');
        $re3 = '2017-09-30';
        $query = RcptArrear::find()
                ->Where(['and',
                ['in', 'amount', $re],
                ['=', 'paid', $re2],
                ['>', 'arrear_date', $re3]
                ])
        ;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => [
        'pageSize' => 10,
    ],
            'sort' => [                
            'defaultOrder'=>[
           
            'arrear_id'=> 'SORT_DESC',
                
                    ]
                
               ],
        ]);
        

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'arrear_id' => $this->arrear_id,
            'arrear_date' => $this->arrear_date,
            'arrear_time' => $this->arrear_time,
            'amount' => $this->amount,
            'receive_money_date' => $this->receive_money_date,
            'receive_money_time' => $this->receive_money_time,
        ]);

        $query->andFilterWhere(['like', 'vn', $this->vn])
                ->andFilterWhere(['like', 'staff', $this->staff])
                ->andFilterWhere(['like', 'rcpno', $this->rcpno])
                ->andFilterWhere(['like', 'finance_number', $this->finance_number])
                ->andFilterWhere(['like', 'paid', $this->paid])
                ->andFilterWhere(['like', 'pt_type', $this->pt_type])
                ->andFilterWhere(['like', 'hn', $this->hn])
                ->andFilterWhere(['like', 'receive_money_staff', $this->receive_money_staff])
                ->andFilterWhere(['like', 'hos_guid', $this->hos_guid])
                ->andFilterWhere(['like', 'an', $this->an]);

        return $dataProvider;
    }

}
