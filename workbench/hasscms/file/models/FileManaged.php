<?php
namespace hasscms\file\models;

use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "file_managed".
 *
 * @property integer $fid
 * @property integer $uid
 * @property string $filename
 * @property string $uri
 * @property string $filemime
 * @property string $filesize
 * @property integer $status
 * @property integer $created
 * @property integer $changed
 */
class FileManaged extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%file_managed}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'uid',
                    'uri',
                    'status',
                ],
                'required'
            ],
            [
                [
                    'uid',
                    'filesize',
                    'status',
                    'created',
                    'changed'
                ],
                'integer'
            ],
            [
                [
                    'filename',
                    'uri',
                    'filemime'
                ],
                'string',
                'max' => 255
            ],
            [
                [
                    'uri'
                ],
                'unique'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fid' => 'The file ID.',
            'uid' => 'The user ID of the file.',
            'filename' => 'Name of the file with no path components.',
            'uri' => 'The URI to access the file (either local or remote).',
            'filemime' => 'The file’s MIME type.',
            'filesize' => 'The size of the file in bytes.',
            'status' => 'The status of the file, temporary (FALSE) and permanent (TRUE).',
            'created' => 'The timestamp that the file was created.',
            'changed' => 'The timestamp that the file was last changed.'
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                "createdAtAttribute"=>"created",
                "updatedAtAttribute"=>"changed"
            ]
        ];
    }

    public function getFileByUri($uri)
    {
        
    }
}
