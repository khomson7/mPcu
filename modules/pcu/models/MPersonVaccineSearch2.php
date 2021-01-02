<?php

namespace app\modules\pcu\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\pcu\models\MPersonVaccine;
use app\modules\pcu\models\PersonVaccine;

/**
 * MPersonVaccineSearch represents the model behind the search form of `app\modules\pcu\models\MPersonVaccine`.
 */
class MPersonVaccineSearch2 extends MPersonVaccine
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['person_vaccine_id'], 'integer'],
            [['vaccine_name', 'vaccine_code', 'vaccine_group', 'export_vaccine_code', 'hos_guid', 'combine_vaccine', 'icode'], 'safe'],
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
      
         
        $query = MPersonVaccine::find()->joinWith('pvaccine');
                 
               // ->where(['IN', 'vaccine_code', $model])
              //  ->andWhere(['NOT IN', 'export_vaccine_code', $model2])
                
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
         
       // $dataProvider->query->joinWith('pvaccine');
        // grid filtering conditions
        $query->andFilterWhere([
          //  'person_vaccine_id' => $this->person_vaccine_id,
        ]);

        $query->andFilterWhere(['like', 'vaccine_name', $this->vaccine_name])
            ->andFilterWhere(['like', 'vaccine_code', $this->vaccine_code])
            ->andFilterWhere(['like', 'vaccine_group', $this->vaccine_group])
            ->andFilterWhere(['like', 'export_vaccine_code', $this->export_vaccine_code])
            ->andFilterWhere(['like', 'hos_guid', $this->hos_guid])
            ->andFilterWhere(['like', 'combine_vaccine', $this->combine_vaccine])
            ->andFilterWhere(['like', 'icode', $this->icode]);

        return $dataProvider;
    }
}
