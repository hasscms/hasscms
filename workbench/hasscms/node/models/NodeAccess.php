<?php

namespace hasscms\node\models;

use Yii;

/**
 * This is the model class for table "node_access".
 *
 * @property integer $nid
 * @property integer $gid
 * @property string $realm
 * @property integer $grant_view
 * @property integer $grant_update
 * @property integer $grant_delete
 */
class NodeAccess extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%node_access}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nid', 'gid', 'realm'], 'required'],
            [['nid', 'gid', 'grant_view', 'grant_update', 'grant_delete'], 'integer'],
            [['realm'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nid' => 'The node.nid this record affects.',
            'gid' => 'The grant ID a user must possess in the specified realm to gain this row’s privileges on the node.',
            'realm' => 'The realm in which the user must possess the grant ID. Each node access node can define one or more realms.',
            'grant_view' => 'Boolean indicating whether a user with the realm/grant pair can view this node.',
            'grant_update' => 'Boolean indicating whether a user with the realm/grant pair can edit this node.',
            'grant_delete' => 'Boolean indicating whether a user with the realm/grant pair can delete this node.',
        ];
    }
}
