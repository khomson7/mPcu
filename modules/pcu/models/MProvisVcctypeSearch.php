<?php

namespace app\modules\pcu\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\pcu\models\MProvisVcctype;
use app\modules\pcu\models\ProvisVcctype;

/**
 * MProvisVcctypeSearch represents the model behind the search form of `app\modules\pcu\models\MProvisVcctype`.
 */
class MProvisVcctypeSearch extends MProvisVcctype
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'hos_guid'], 'safe'],
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
        $model = ProvisVcctype::find()->select('code')
                ->all();
               
        $query = MProvisVcctype::find()
                ->where(['NOT IN', 'code', $model]);

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
        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'hos_guid', $this->hos_guid]);

        return $dataProvider;
    }
}
