<?php

namespace hasscms\comment\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use hasscms\comment\models\Comment;

/**
 * CommentSearch represents the model behind the search form about `hasscms\comment\models\Comment`.
 */
class CommentSearch extends Comment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid', 'pid', 'entity_id', 'uid', 'status', 'deleted', 'created', 'changed'], 'integer'],
            [['type', 'entity_type', 'field_name', 'subject', 'comment_body', 'name', 'mail', 'homepage', 'hostname', 'thread'], 'safe'],
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
        $query = Comment::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'cid' => $this->cid,
            'pid' => $this->pid,
            'entity_id' => $this->entity_id,
            'uid' => $this->uid,
            'status' => $this->status,
            'deleted' => $this->deleted,
            'created' => $this->created,
            'changed' => $this->changed,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'entity_type', $this->entity_type])
            ->andFilterWhere(['like', 'field_name', $this->field_name])
            ->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'comment_body', $this->comment_body])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'mail', $this->mail])
            ->andFilterWhere(['like', 'homepage', $this->homepage])
            ->andFilterWhere(['like', 'hostname', $this->hostname])
            ->andFilterWhere(['like', 'thread', $this->thread]);

        return $dataProvider;
    }
}
