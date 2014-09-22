<?php

namespace hasscms\comment\models;

use Yii;

/**
 * This is the model class for table "comment_type".
 *
 * @property string $type
 * @property string $name
 * @property string $description
 */
class CommentType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comment_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'name'], 'required'],
            [['description'], 'string'],
            [['type', 'name'], 'string', 'max' => 255],
            [['type'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'type' => 'the term group alias',
            'name' => 'The term group name.',
            'description' => 'A description of the term group.',
        ];
    }
}
