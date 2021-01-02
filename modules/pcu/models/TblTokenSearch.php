<?php

namespace app\modules\pcu\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\pcu\models\TblToken;

/**
 * TblTokenSearch represents the model behind the search form of `app\modules\pcu\models\TblToken`.
 */
class TblTokenSearch extends TblToken
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'username_id', 'user_access_group'], 'integer'],
            [['token_', 'group_name', 'group_status', 'department_id', 'active'], 'safe'],
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
        $query = TblToken::find();

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
            'username_id' => $this->username_id,
            'user_access_group' => $this->user_access_group,
        ]);

        $query->andFilterWhere(['like', 'token_', $this->token_])
            ->andFilterWhere(['like', 'group_name', $this->group_name])
            ->andFilterWhere(['like', 'group_status', $this->group_status])
            ->andFilterWhere(['like', 'department_id', $this->department_id])
            ->andFilterWhere(['like', 'active', $this->active]);

        return $dataProvider;
    }
}
