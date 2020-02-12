<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property int $product_id
 * @property string|null $mpn
 * @property int|null $brand_id
 * @property string|null $name
 * @property string $updated
 *
 * @property Brand $brand
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['brand_id'], 'integer'],
            [['updated'], 'safe'],
            [['mpn', 'name'], 'string', 'max' => 100],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'brand_id']],
           // [['brand_id', 'mpn'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'mpn' => 'Mpn',
            'brand_id' => 'Brand ID',
            'name' => 'Name',
            'updated' => 'Updated',
        ];
    }

    /**
     * Gets query for [[Brand]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\BrandQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['brand_id' => 'brand_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ProductQuery(get_called_class());
    }

   /* public function search($params)
    {
        $query = Product::find();


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'product_id' => $this->product_id,
            'brand_id' => $this->brand_id,
        ]);

        $query->andFilterWhere(['like', 'mpn', $this->mpn])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }*/

    public function search($params)
    {
        $query = Product::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // load the search form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // adjust the query by adding the filters
        $query->andFilterWhere(['id' => $this->product_id]);
        $query->andFilterWhere(['like', 'brand_id', $this->brand_id])
            ->andFilterWhere(['like', 'mpn', $this->mpn]);

        return $dataProvider;
    }
}
