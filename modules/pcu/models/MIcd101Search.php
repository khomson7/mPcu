<?php

namespace app\modules\pcu\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\pcu\models\MIcd101;

/**
 * MIcd101Search represents the model behind the search form of `app\modules\pcu\models\MIcd101`.
 */
class MIcd101Search extends MIcd101
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'spclty', 'tname', 'code3', 'code4', 'code5', 'ipd_valid', 'icd10compat', 'icd10tmcompat', 'active_status', 'hos_guid', 'hos_guid_ext'], 'safe'],
            [['sex'], 'integer'],
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
        $searchVal = 'U';
        $model = Icd101::find()->select('code')
                 // ->where(['IS','provis_labcode',$provislab])
                ->where(['like', 'code', $searchVal])
                ->all();
        
        $query = MIcd101::find();
                $query->where(['NOT IN', 'code', $model])
                        ->andWhere(['like', 'code', $searchVal]);

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
            'sex' => $this->sex,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'spclty', $this->spclty])
            ->andFilterWhere(['like', 'tname', $this->tname])
            ->andFilterWhere(['like', 'code3', $this->code3])
            ->andFilterWhere(['like', 'code4', $this->code4])
            ->andFilterWhere(['like', 'code5', $this->code5])
            ->andFilterWhere(['like', 'ipd_valid', $this->ipd_valid])
            ->andFilterWhere(['like', 'icd10compat', $this->icd10compat])
            ->andFilterWhere(['like', 'icd10tmcompat', $this->icd10tmcompat])
            ->andFilterWhere(['like', 'active_status', $this->active_status])
            ->andFilterWhere(['like', 'hos_guid', $this->hos_guid])
            ->andFilterWhere(['like', 'hos_guid_ext', $this->hos_guid_ext]);

        return $dataProvider;
    }
}
