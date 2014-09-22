<?php

namespace hasscms\file\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use hasscms\file\models\FileUsage;

/**
 * FileUsageSearch represents the model behind the search form about `hasscms\file\models\FileUsage`.
 */
class FileUsageSearch extends FileUsage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fid', 'count'], 'integer'],
            [['type', 'id'], 'safe'],
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
        $query = FileUsage::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'fid' => $this->fid,
            'count' => $this->count,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'id', $this->id]);

        return $dataProvider;
    }
}
