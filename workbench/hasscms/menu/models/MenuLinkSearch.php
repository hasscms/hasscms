<?php

namespace hasscms\menu\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use hasscms\menu\models\MenuLink;

/**
 * MenuLinkSearch represents the model behind the search form about `hasscms\menu\models\MenuLink`.
 */
class MenuLinkSearch extends MenuLink
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mlid', 'pid', 'encode', 'visible', 'weight', 'active_with_parent'], 'integer'],
            [['type', 'label', 'options', 'url', 'route_name', 'route_parameters', 'linkOptions', 'data', 'active_with_others'], 'safe'],
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
        $query = MenuLink::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'mlid' => $this->mlid,
            'pid' => $this->pid,
            'encode' => $this->encode,
            'visible' => $this->visible,
            'weight' => $this->weight,
            'active_with_parent' => $this->active_with_parent,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'options', $this->options])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'route_name', $this->route_name])
            ->andFilterWhere(['like', 'route_parameters', $this->route_parameters])
            ->andFilterWhere(['like', 'linkOptions', $this->linkOptions])
            ->andFilterWhere(['like', 'data', $this->data])
            ->andFilterWhere(['like', 'active_with_others', $this->active_with_others]);

        return $dataProvider;
    }
}
