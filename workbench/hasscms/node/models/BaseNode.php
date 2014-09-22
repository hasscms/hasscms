<?php
namespace hasscms\node\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "node".
 *
 * @property integer $nid
 * @property string $type
 * @property string $langcode
 * @property string $title
 * @property integer $uid
 * @property integer $status
 * @property integer $created
 * @property integer $changed
 * @property integer $promote
 * @property integer $sticky
 * @property integer $default_langcode
 */
class BaseNode extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%node}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'type',
                    'title',
                    'status',
                    'created',
                    'promote',
                    'sticky'
                ],
                'required'
            ],
            [
                [
                    'nid',
                    'uid',
                    'status',
                    'promote',
                    'sticky',
                    'default_langcode'
                ],
                'integer'
            ],
            [
                [
                    'created'
                ],
                'date',
                "format" => "Y-m-d H:i:s"
            ],
            [
                [
                    'type'
                ],
                'string',
                'max' => 32
            ],
            [
                [
                    'langcode'
                ],
                'string',
                'max' => 12
            ],
            [
                [
                    'title'
                ],
                'string',
                'max' => 255
            ],
            [
                [
                    'changed'
                ],
                'safe'
            ],
            [
                [
                    'uid'
                ],
                'default',
                'value'=>\Yii::$app->get("user")->id
            ],
            [
            [
                'langcode'
            ],
            'default',
            'value' => "zh-CN"
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nid' => 'The node ID.',
            'type' => 'The node type.',
            'langcode' => '语言',
            'title' => '标题',
            'uid' => '用户ID',
            'status' => '保存并发布',
            'created' => '创建日期',
            'changed' => '修改日期',
            'promote' => '推荐到首页',
            'sticky' => '置顶',
            'default_langcode' => '是否默认语言'
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'changed' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'changed',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'changed'
                ]
            ],
            'createdUpdate' => [
                'class' => 'yii\behaviors\AttributeBehavior',
                'value'=>function ($event){
                   return strtotime($event->sender->created);
                },
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'created'
                ]
            ],
            'createdFind' => [
                'class' => 'yii\behaviors\AttributeBehavior',
                'value'=>function($event){
                   return date("Y-m-d H:i:s",$event->sender->created);
                },
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => 'created'
                ]
            ]
        ];
    }
}
