<?php
namespace hasscms\node\models;

use yii\validators\Validator;
class NodeAttached extends  \yii\db\ActiveRecord
{
    public static $tableName;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%' . static::$tableName . '}}'; 
    }

       
    public function addRule($attributes, $validator, $options = [])
    {
        $validators = $this->getValidators();
        $validators->append(Validator::createValidator($validator, $this, (array) $attributes, $options));
    
        return $this;
    }
    

}

?>