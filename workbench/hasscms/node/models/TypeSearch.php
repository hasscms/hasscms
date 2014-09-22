<?php

namespace hasscms\node\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use hasscms\node\models\NodeType;

/**
 * TypeSearch represents the model behind the search form about `hasscms\node\models\NodeType`.
 */
class TypeSearch extends NodeType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'name', 'description'], 'safe'],
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
        $query = NodeType::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
