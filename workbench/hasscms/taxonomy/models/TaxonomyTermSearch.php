<?php

namespace hasscms\taxonomy\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use hasscms\taxonomy\models\TaxonomyTerm;

/**
 * TaxonomyTermSearch represents the model behind the search form about `hasscms\taxonomy\models\TaxonomyTerm`.
 */
class TaxonomyTermSearch extends TaxonomyTerm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tid', 'pid', 'weight'], 'integer'],
            [['type', 'name', 'description', 'slug'], 'safe'],
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
        $query = TaxonomyTerm::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'tid' => $this->tid,
            'pid' => $this->pid,
            'weight' => $this->weight,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
