<?php

namespace hasscms\field\models;

use Yii;

/**
 * This is the model class for table "{{%field}}".
 *
 * @property string $collection
 * @property string $name
 * @property resource $data
 * @property integer $weight
 */
class Field extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%field}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data'], 'string'],
            [['weight'], 'required'],
            [['weight'], 'integer'],
            [['collection', 'name'], 'string', 'max' => 255],
            [['collection', 'name'], 'unique', 'targetAttribute' => ['collection', 'name'], 'message' => 'The combination of 一般为模块名 and Name has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'collection' => '一般为模块名',
            'name' => 'Name',
            'data' => 'Data',
            'weight' => 'Weight',
        ];
    }

    public static function findFieldsByType($collection,$name)
    {
		return 	static::find()->andWhere(["collection"=>$collection,"name"=>$name])->asArray()->all() ;
    }
}
