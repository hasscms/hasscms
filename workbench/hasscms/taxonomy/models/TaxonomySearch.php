<?php

namespace hasscms\taxonomy\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use hasscms\taxonomy\models\Taxonomy;

/**
 * TaxonomySearch represents the model behind the search form about `hasscms\taxonomy\models\Taxonomy`.
 */
class TaxonomySearch extends Taxonomy
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
        $query = Taxonomy::find();

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
