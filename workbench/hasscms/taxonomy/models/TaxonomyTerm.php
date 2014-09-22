<?php

namespace hasscms\taxonomy\models;

use Yii;
use yii\base\Exception;
/**
 * This is the model class for table "taxonomy_term".
 *
 * @property string $tid
 * @property string $type
 * @property string $pid
 * @property string $name
 * @property string $description
 * @property string $slug
 * @property integer $weight
 *
 * @property Taxonomy $taxonomySlug
 */
class TaxonomyTerm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%taxonomy_term}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'pid', 'name', 'slug', 'weight'], 'required'],
            [['pid', 'weight'], 'integer'],
            [['description'], 'string'],
            [['type', 'name', 'slug'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tid' => 'The term ID.',
            'type' => '分类别名',
            'pid' => '父分类项ID',
            'name' => '分类项name.',
            'description' => '分类项说明',
            'slug' => '别名',
            'weight' => '排序',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxonomySlug()
    {
        return $this->hasOne(Taxonomy::className(), ['slug' => 'type']);
    }

	public function getTermsByTaxonomySlug()
	{
		if(empty($this->type))
		{
		  throw new Exception("type 不能为空");
		}

		return static::find()->where("`type`='".$this->type."'")->asArray()
		->all();;
	}
}
