<?php

namespace hasscms\comment\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use hasscms\comment\models\CommentStatistics;

/**
 * CommentStatisticsSearch represents the model behind the search form about `hasscms\comment\models\CommentStatistics`.
 */
class CommentStatisticsSearch extends CommentStatistics
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entity_id', 'last_comment_id', 'last_comment_timestamp', 'last_comment_uid', 'comment_count'], 'integer'],
            [['entity_type', 'slug', 'last_comment_name'], 'safe'],
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
        $query = CommentStatistics::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'entity_id' => $this->entity_id,
            'last_comment_id' => $this->last_comment_id,
            'last_comment_timestamp' => $this->last_comment_timestamp,
            'last_comment_uid' => $this->last_comment_uid,
            'comment_count' => $this->comment_count,
        ]);

        $query->andFilterWhere(['like', 'entity_type', $this->entity_type])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'last_comment_name', $this->last_comment_name]);

        return $dataProvider;
    }
}
