<?php

namespace app\modules\pcu\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\pcu\models\MIcd10HealthMed;

/**
 * MIcd10HealthMedSearch represents the model behind the search form of `app\modules\pcu\models\MIcd10HealthMed`.
 */
class MIcd10HealthMedSearch extends MIcd10HealthMed
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['icd10', 'name', 'hos_guid', 'hos_guid_ext'], 'safe'],
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
         
        $model = Icd10HealthMed::find()->select('icd10')
                 // ->where(['IS','provis_labcode',$provislab])
                ->all();
        
        
        
        $query = MIcd10HealthMed::find()
                ->where(['NOT IN', 'icd10', $model]);

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
        $query->andFilterWhere(['like', 'icd10', $this->icd10])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'hos_guid', $this->hos_guid])
            ->andFilterWhere(['like', 'hos_guid_ext', $this->hos_guid_ext]);

        return $dataProvider;
    }
}
