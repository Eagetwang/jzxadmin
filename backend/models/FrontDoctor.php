<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "front_doctor".
 *
 * @property string $id
 * @property string $name
 * @property string $img
 * @property string $level
 * @property string $department
 * @property string $address_time
 * @property string $introduce
 * @property string $major
 * @property integer $create_time
 * @property integer $createby
 * @property integer $update_time
 * @property integer $updateby
 */
class FrontDoctor extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'front_doctor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address_time', 'introduce', 'major'], 'required'],
            [['address_time', 'introduce', 'major','img'], 'string'],
            [['create_time', 'createby', 'update_time', 'updateby'], 'integer'],
            [['name', 'level', 'department'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '姓名',
            'img' => '头像',
            'level' => '级别',
            'department' => '科室',
            'address_time' => '门诊时间、门诊地点',
            'introduce' => '个人简介',
            'major' => '专业特长',
            'create_time' => '创建时间',
            'createby' => '创建人',
            'update_time' => '更新时间',
            'updateby' => '更新人',
        ];
    }

  /**
     * 返回数据库字段信息，仅在生成CRUD时使用，如不需要生成CRUD，请注释或删除该getTableColumnInfo()代码
     * COLUMN_COMMENT可用key如下:
     * label - 显示的label
     * inputType 控件类型, 暂时只支持text,hidden  // select,checkbox,radio,file,password,
     * isEdit   是否允许编辑，如果允许编辑将在添加和修改时输入
     * isSearch 是否允许搜索
     * isDisplay 是否在列表中显示
     * isOrder 是否排序
     * udc - udc code，inputtype为select,checkbox,radio三个值时用到。
     * 特别字段：
     * id：主键。必须含有主键，统一都是id
     * create_date: 创建时间。生成的代码自动赋值
     * update_date: 修改时间。生成的代码自动赋值
     */
    public function getTableColumnInfo(){
        return array(
        'id' => array(
                        'name' => 'id',
                        'allowNull' => false,
//                         'autoIncrement' => true,
//                         'comment' => '',
//                         'dbType' => "int(11) unsigned",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => true,
                        'phpType' => 'string',
                        'precision' => '11',
                        'scale' => '',
                        'size' => '11',
                        'type' => 'integer',
                        'unsigned' => true,
                        'label'=>$this->getAttributeLabel('id'),
                        'inputType' => 'hidden',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'name' => array(
                        'name' => 'name',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '姓名',
//                         'dbType' => "varchar(100)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '100',
                        'scale' => '',
                        'size' => '100',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('name'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'level' => array(
                        'name' => 'level',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '级别',
//                         'dbType' => "varchar(100)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '100',
                        'scale' => '',
                        'size' => '100',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('level'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'department' => array(
                        'name' => 'department',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '科室',
//                         'dbType' => "varchar(100)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '100',
                        'scale' => '',
                        'size' => '100',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('department'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'address_time' => array(
                        'name' => 'address_time',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '门诊时间、门诊地点',
//                         'dbType' => "text",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '',
                        'scale' => '',
                        'size' => '',
                        'type' => 'text',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('address_time'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'introduce' => array(
                        'name' => 'introduce',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '个人简介',
//                         'dbType' => "text",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '',
                        'scale' => '',
                        'size' => '',
                        'type' => 'text',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('introduce'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'major' => array(
                        'name' => 'major',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '专业特长',
//                         'dbType' => "text",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '',
                        'scale' => '',
                        'size' => '',
                        'type' => 'text',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('major'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'create_time' => array(
                        'name' => 'create_time',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '创建时间',
//                         'dbType' => "int(10)",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '10',
                        'scale' => '',
                        'size' => '10',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('create_time'),
                        'inputType' => 'text',
                        'isEdit' => false,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'createby' => array(
                        'name' => 'createby',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '创建人',
//                         'dbType' => "int(11)",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '11',
                        'scale' => '',
                        'size' => '11',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('createby'),
                        'inputType' => 'text',
                        'isEdit' => false,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'update_time' => array(
                        'name' => 'update_time',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '更新时间',
//                         'dbType' => "int(10)",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '10',
                        'scale' => '',
                        'size' => '10',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('update_time'),
                        'inputType' => 'text',
                        'isEdit' => false,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'updateby' => array(
                        'name' => 'updateby',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '更新人',
//                         'dbType' => "int(11)",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '11',
                        'scale' => '',
                        'size' => '11',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('updateby'),
                        'inputType' => 'text',
                        'isEdit' => false,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		        );
        
    }

    public function getById($id){
        return $this->find()->where(['id'=>$id])->one();
    }
 
}
