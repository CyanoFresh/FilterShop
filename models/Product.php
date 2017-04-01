<?php

namespace app\models;

use voskobovich\linker\LinkerBehavior;
use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $vendor_code
 * @property string $name
 *
 * @property string $category_ids
 *
 * @property ProductCategory[] $productCategories
 * @property Category[] $categories
 * @property ProductParameter[] $productParameters
 * @property Parameter[] $parameters
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => LinkerBehavior::className(),
                'relations' => [
                    'category_ids' => 'categories',
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vendor_code', 'name'], 'required'],
            [['vendor_code', 'name'], 'string', 'max' => 255],
            [['category_ids'], 'each', 'rule' => ['integer']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vendor_code' => 'Vendor Code',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCategories()
    {
        return $this->hasMany(ProductCategory::className(), ['product_id' => 'id'])->inverseOf('product');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('product_category', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductParameters()
    {
        return $this->hasMany(ProductParameter::className(), ['product_id' => 'id'])->inverseOf('product');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParameters()
    {
        return $this->hasMany(Parameter::className(), ['id' => 'parameter_id'])->viaTable('product_parameter', ['product_id' => 'id']);
    }
}
