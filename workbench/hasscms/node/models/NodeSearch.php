<?php

namespace hasscms\node\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use hasscms\node\models\Node;

/**
 * NodeSearch represents the model behind the search form about `hasscms\node\models\Node`.
 */
class NodeSearch extends BaseNode
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nid', 'uid', 'status', 'created', 'changed', 'promote', 'sticky', 'default_langcode'], 'integer'],
            [['type', 'langcode', 'title'], 'safe'],
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
        $query = BaseNode::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'nid' => $this->nid,
            'uid' => $this->uid,
            'status' => $this->status,
            'created' => $this->created,
            'changed' => $this->changed,
            'promote' => $this->promote,
            'sticky' => $this->sticky,
            'default_langcode' => $this->default_langcode,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'langcode', $this->langcode])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
