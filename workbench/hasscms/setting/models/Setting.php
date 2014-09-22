<?php

namespace hasscms\setting\models;

use Yii;
use hasscms\base\helper\Serializer;

/**
 * This is the model class for table "setting".
 *
 * @property integer $id
 * @property string $collection
 * @property string $name
 * @property string $data
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%setting}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data'], 'string'],
            [['collection', 'name'], 'string', 'max' => 255],
            [['collection', 'name'], 'unique', 'targetAttribute' => ['collection', 'name'], 'message' => 'The combination of Collection and Name has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'collection' => 'Collection',
            'name' => 'Name',
            'data' => 'Data',
        ];
    }
    
    /**
     * field
     *
     *
     * field.storage.node.field_title
     *
     *
     * name =
     *
     *
     * @inheritdoc
     */
    public function getSettings()
    {
        $settings = static::find()
        ->asArray()
        ->all();
    
        $result = [];
    
        foreach ($settings as $setting) {
            $result[$setting["collection"]][$setting['name']] = Serializer::unserialize($setting["data"]);
        }
    
        return $result;
    }
    
    public function getSettingsByCollection($collection)
    {
        $settings = $this->getSettings();
    
        if(isset($settings[$collection]))
        {
            return $settings[$collection];
        }
    
        return null;
    }
    
    /**
     * @inheritdoc
     */
    public function setSetting($collection, $name, $data)
    {
        $model = static::findOne([
            'collection' => $collection,
            'name' => $name
        ]);
    
        if ($model === null) {
            $model = new static();
        }
        $model->collection = $collection;
        $model->name = $name;
        $model->data = Serializer::serialize($data);
    
        return $model->save();
    }
    
    public function setSettingsWithCollection($collection, array $data)
    {
        $transaction = static::getDb()->beginTransaction();
        try {
    
            $result = true;
    
            foreach ($data as $name => $value) {
                $result = $this->setSetting($collection, $name, $value);
                if ($result === false) {
                    $transaction->rollBack();
                    break;
                }
            }
    
            if($result === true){
                $transaction->commit();
                return true;
            }
        } catch (\yii\base\Exception $e) {
            $transaction->rollBack();
            throw $e;
            return false;
        }
    }
    
   
    
    /**
     * @inheritdoc
     */
    public function deleteSetting($collection, $name)
    {
        $model = static::findOne([
            'collection' => $collection,
            'name' => $name
        ]);
    
        if ($model) {
            return $model->delete();
        }
        return true;
    }
    
    /**
     * @inheritdoc
     */
    public function deleteAllSettings()
    {
        return static::deleteAll();
    }
}
