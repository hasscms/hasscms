<?php

namespace hasscms\comment\models;

use Yii;

/**
 * This is the model class for table "comment_statistics".
 *
 * @property integer $entity_id
 * @property string $entity_type
 * @property string $slug
 * @property integer $last_comment_id
 * @property integer $last_comment_timestamp
 * @property string $last_comment_name
 * @property integer $last_comment_uid
 * @property integer $comment_count
 */
class CommentStatistics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comment_statistics}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entity_id', 'entity_type', 'slug', 'comment_count'], 'required'],
            [['entity_id', 'last_comment_id', 'last_comment_timestamp', 'last_comment_uid', 'comment_count'], 'integer'],
            [['entity_type', 'slug'], 'string', 'max' => 32],
            [['last_comment_name'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'entity_id' => 'The entity_id of the entity for which the statistics are compiled.',
            'entity_type' => 'The entity_type of the entity to which this comment is a reply.',
            'slug' => '评论唯一标识符..如果没有设置则为type-id',
            'last_comment_id' => 'The comment.cid of the last comment.',
            'last_comment_timestamp' => 'The Unix timestamp of the last comment that was posted within this node, from comment.changed.',
            'last_comment_name' => 'The name of the latest author to post a comment on this node, from comment.name.',
            'last_comment_uid' => 'The user ID of the latest author to post a comment on this node, from comment.uid.',
            'comment_count' => 'The total number of comments on this entity.',
        ];
    }
}
