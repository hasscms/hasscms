<?php

namespace hasscms\menu\models;

use Yii;
use yii\base\Exception;
use hasscms\base\helper\Serializer;
/**
 * This is the model class for table "menu_link".
 *
 * @property string $mlid
 * @property string $type
 * @property string $pid
 * @property string $label
 * @property integer $encode
 * @property string $options
 * @property string $url
 * @property string $route_name
 * @property string $route_parameters
 * @property string $linkOptions
 * @property integer $visible
 * @property integer $weight
 * @property string $data
 * @property string $active_with_others
 * @property integer $active_with_parent
 *
 * @property Menu $menuSlug
 */
class MenuLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu_link}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'encode', 'visible', 'weight', 'active_with_parent'], 'integer'],
            [['encode', 'active_with_parent'], 'required'],
            [['options', 'route_parameters', 'linkOptions', 'data', 'active_with_others'], 'string'],
            [['type', 'label', 'url', 'route_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mlid' => 'The menu link ID (mlid) is the integer primary key.',
            'type' => '菜单别名',
            'pid' => '父链接ID',
            'label' => '链接名称.',
            'encode' => '是否编码',
            'options' => '链接外层选项,格式xx:xx,xx:xx',
            'url' => '链接地址',
            'route_name' => '路由',
            'route_parameters' => '路由参数,格式xx:xx,xx:xx',
            'linkOptions' => '链接选项,格式xx:xx,xx:xx',
            'visible' => '是否可见',
            'weight' => '排序',
            'data' => 'Data',
            'active_with_others' => '根据其他路由激活,格式:xx,xx',
            'active_with_parent' => '一般在,active_with_others后,会出冲突,使用该值进行重置',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuSlug()
    {
        return $this->hasOne(Menu::className(), ['slug' => 'type']);
    }
    
    public function getLinksByMenuSlug()
    {
      if (empty($this->type)) {
        throw new Exception("type 不能为空");
      }
    
      return static::find()->where("`type`='" . $this->type . "'")
      ->asArray()
      ->all();
    }
    
    public function afterFind()
    {
      parent::afterFind();
    
      $this->route_parameters = http_build_query(Serializer::unserializeToArray($this->route_parameters),'',',');
    
      $this->options = http_build_query(Serializer::unserializeToArray($this->options),'',',');
    
      $this->linkOptions = http_build_query(Serializer::unserializeToArray($this->linkOptions),'',',');
      
      $this->active_with_others = implode(",", Serializer::unserializeToArray($this->active_with_others));
    }
    
    public function beforeSave($insert)
    {
      if (parent::beforeSave($insert)) {
    
        $temp = null;
        parse_str(str_replace(",", "&", $this->route_parameters),$temp );
        $this->route_parameters =  Serializer::serialize($temp);
    
        $temp = null;
        parse_str(str_replace(",", "&", $this->options),$temp );
        $this->options =  Serializer::serialize($temp);
    
        $temp = null;
        parse_str(str_replace(",", "&", $this->linkOptions),$temp );
        $this->linkOptions =  Serializer::serialize($temp);
        
        $this->active_with_others = Serializer::serialize(explode(',',  $this->active_with_others));
    
        return true;
      } else {
        return false;
      }
    }
}
