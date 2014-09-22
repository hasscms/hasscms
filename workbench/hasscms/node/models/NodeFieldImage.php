<?php

namespace hasscms\node\models;

use Yii;

/**
 * This is the model class for table "node__field_image".
 *
 * @property integer $nid
 * @property integer $field_image_target_id
 * @property string $field_image_alt
 * @property string $field_image_title
 * @property integer $field_image_width
 * @property integer $field_image_height
 * @property string $field_name
 */
class NodeFieldImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%node__field_image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nid', 'field_image_target_id'], 'required'],
            [['nid', 'field_image_target_id', 'field_image_width', 'field_image_height'], 'integer'],
            [['field_image_alt'], 'string', 'max' => 512],
            [['field_image_title'], 'string', 'max' => 1024],
            [['field_name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nid' => 'The entity id this data is attached to',
            'field_image_target_id' => 'The ID of the file entity.',
            'field_image_alt' => 'Alternative image text, for the image’s ’alt’ attribute.',
            'field_image_title' => 'Image title text, for the image’s ’title’ attribute.',
            'field_image_width' => 'The width of the image in pixels.',
            'field_image_height' => 'The height of the image in pixels.',
            'field_name' => 'Field Name',
        ];
    }
}
