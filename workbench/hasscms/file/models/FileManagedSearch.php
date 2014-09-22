<?php

namespace hasscms\file\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use hasscms\file\models\FileManaged;

/**
 * FileManagedSearch represents the model behind the search form about `hasscms\file\models\FileManaged`.
 */
class FileManagedSearch extends FileManaged
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fid', 'uid', 'filesize', 'status', 'created', 'changed'], 'integer'],
            [['filename', 'uri', 'filemime'], 'safe'],
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
        $query = FileManaged::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'fid' => $this->fid,
            'uid' => $this->uid,
            'filesize' => $this->filesize,
            'status' => $this->status,
            'created' => $this->created,
            'changed' => $this->changed,
        ]);

        $query->andFilterWhere(['like', 'filename', $this->filename])
            ->andFilterWhere(['like', 'uri', $this->uri])
            ->andFilterWhere(['like', 'filemime', $this->filemime]);

        return $dataProvider;
    }
}
