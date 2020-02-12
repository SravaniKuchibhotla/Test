<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%brand}}".
 *
 * @property int $brand_id
 * @property string|null $logo
 * @property string|null $name
 * @property string $updated
 *
 * @property Product[] $products
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%brand}}';
    }

    /*public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => BlameableBehavior::class,
                'updatedByAttribute' => false
            ]
        ];
    }*/

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['logo', 'name'], 'required'],
            [['updated'], 'safe'],
            [['logo', 'name'], 'string', 'max' => 100],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'brand_id' => 'Brand ID',
            'logo' => 'Logo',
            'name' => 'Name',
            'updated' => 'Updated',
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\ProductQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['brand_id' => 'brand_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\BrandQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\BrandQuery(get_called_class());
    }
}
