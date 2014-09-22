<?php

namespace hasscms\comment\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $cid
 * @property string $type
 * @property integer $pid
 * @property integer $entity_id
 * @property string $entity_type
 * @property string $field_name
 * @property string $subject
 * @property string $comment_body
 * @property integer $uid
 * @property string $name
 * @property string $mail
 * @property string $homepage
 * @property string $hostname
 * @property integer $status
 * @property string $thread
 * @property integer $deleted
 * @property integer $created
 * @property integer $changed
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid', 'type', 'pid', 'uid', 'homepage', 'status', 'thread', 'created'], 'required'],
            [['cid', 'pid', 'entity_id', 'uid', 'status', 'deleted', 'created', 'changed'], 'integer'],
            [['comment_body'], 'string'],
            [['type', 'entity_type', 'field_name'], 'string', 'max' => 32],
            [['subject'], 'string', 'max' => 64],
            [['name'], 'string', 'max' => 60],
            [['mail'], 'string', 'max' => 254],
            [['homepage', 'thread'], 'string', 'max' => 255],
            [['hostname'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cid' => 'The comment ID.',
            'type' => 'The comment type.',
            'pid' => 'The parent comment ID if this is a reply to a comment.',
            'entity_id' => 'The ID of the entity of which this comment is a reply.',
            'entity_type' => 'The entity type to which this comment is attached.',
            'field_name' => '可不设置,区别同一个模型下需要两个评论才使用该字段',
            'subject' => 'Subject',
            'comment_body' => 'Comment Body',
            'uid' => 'The user ID of the comment author.',
            'name' => 'The comment author’s name.',
            'mail' => 'The comment author’s email address.',
            'homepage' => 'The comment author’s home page address.',
            'hostname' => 'The comment author’s hostname.',
            'status' => 'A boolean indicating whether the comment is published.',
            'thread' => 'The alphadecimal representation of the comment’s place in a thread, consisting of a base 36 string prefixed by an integer indicating its length.',
            'deleted' => 'A boolean indicating whether this data item has been deleted',
            'created' => 'The time that the comment was created.',
            'changed' => 'The time that the comment was last edited.',
        ];
    }
}
