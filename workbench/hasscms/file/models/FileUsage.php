<?php

namespace hasscms\file\models;

use Yii;

/**
 * This is the model class for table "file_usage".
 *
 * @property integer $fid
 * @property string $type
 * @property string $id
 * @property integer $count
 */
class FileUsage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%file_usage}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fid', 'type', 'id'], 'required'],
            [['fid', 'count'], 'integer'],
            [['type', 'id'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fid' => 'File ID.',
            'type' => 'The name of the object type in which the file is used.',
            'id' => 'The primary key of the object using the file.',
            'count' => 'The number of times this file is used by this object.',
        ];
    }
    
    
    
    
}
