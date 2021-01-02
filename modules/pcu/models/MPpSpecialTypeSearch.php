<?php

namespace app\modules\pcu\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\pcu\models\MPpSpecialType;

/**
 * MPpSpecialTypeSearch represents the model behind the search form of `app\modules\pcu\models\MPpSpecialType`.
 */
class MPpSpecialTypeSearch extends MPpSpecialType
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pp_special_type_id'], 'integer'],
            [['pp_special_type_name', 'hos_guid', 'pp_special_code'], 'safe'],
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
        $model = PpSpecialType::find()->select('pp_special_type_id')
                ->all()
                ;
        
        $query = MPpSpecialType::find()
                ->where(['NOT IN' ,'pp_special_type_id',$model])
                ;

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
            'pp_special_type_id' => $this->pp_special_type_id,
        ]);

        $query->andFilterWhere(['like', 'pp_special_type_name', $this->pp_special_type_name])
            ->andFilterWhere(['like', 'hos_guid', $this->hos_guid])
            ->andFilterWhere(['like', 'pp_special_code', $this->pp_special_code]);

        return $dataProvider;
    }
}
