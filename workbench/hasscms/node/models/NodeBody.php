<?php
namespace hasscms\node\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "node__body".
 *
 * @property integer $nid
 * @property string $body_value
 * @property string $body_summary
 * @property string $body_format
 * @property string $field_name
 */
class NodeBody extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%node__body}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'nid'
                ],
                'required'
            ],
            [
                [
                    'nid'
                ],
                'integer'
            ],
            [
                [
                    'body_value',
                    'body_summary'
                ],
                'string'
            ],
            [
                [
                    'body_format'
                ],
                'string',
                'max' => 255
            ],
            [
                [
                    'field_name'
                ],
                'string',
                'max' => 32
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nid' => 'The entity id this data is attached to',
            'body_value' => '文本',
            'body_summary' => '摘要',
            'body_format' => '文本格式',
            'field_name' => 'Field Name'
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'bodyinsert' => [
                'class' => 'hasscms\file\behaviors\DecodeFileBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'body_value',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'body_value'
                ]
            ],
            'bodyfind' => [
                'class' => 'hasscms\file\behaviors\EncodeFileBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => 'body_value',
                ]
            ],
        ];
    }

    public function loadDefaultValues($skipIfSet = true)
    {
        $this->body_format = "basic_html";
        return $this;
    }

    public static function getFormatList()
    {
        return [
            "plain_text" => "纯文本",
            "basic_html" => "基本HTML",
            "restricted_html" => "限制HTML",
            "full_html" => "全部HTML"
        ];
    }
}
