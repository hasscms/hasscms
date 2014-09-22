<?php

namespace hasscms\node\models;

use Yii;

/**
 * This is the model class for table "node__field_tags".
 *
 * @property integer $nid
 * @property integer $field_tags_target_id
 */
class NodeFieldTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%node__field_tags}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nid'], 'required'],
            [['nid', 'field_tags_target_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nid' => 'The entity id this data is attached to',
            'field_tags_target_id' => 'Field Tags Target ID',
        ];
    }
}
