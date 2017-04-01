<?php

namespace app\models;

use Yii;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "product_parameter".
 *
 * @property integer $product_id
 * @property integer $parameter_id
 * @property string $value
 *
 * @property Parameter $parameter
 * @property Product $product
 */
class ProductParameter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_parameter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'parameter_id'], 'required'],
            [['product_id', 'parameter_id'], 'integer'],
            [['value'], 'string'],
            [['parameter_id'], 'exist', 'skipOnError' => true, 'targetClass' => Parameter::className(), 'targetAttribute' => ['parameter_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'parameter_id' => 'Parameter ID',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParameter()
    {
        return $this->hasOne(Parameter::className(), ['id' => 'parameter_id'])->inverseOf('productParameters');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id'])->inverseOf('productParameters');
    }

    /**
     * @return int
     */
    public function getCount($category_id = false)
    {
        $count = 0;

        $count = ProductCategory::find()
            ->joinWith(['product', 'product.productParameters'])->where([
            'category_id' => $category_id,
            'product.productParameter.value' => $this->value,
        ])->count();

        return $count;
    }
}
