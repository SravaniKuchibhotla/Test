<?php


namespace app\controllers;
use Yii;
//use app\controllers\yii;
use app\models\Brand;
use app\models\Product;
use app\models\ProductSearch;
use app\models\query\ProductQuery;
use yii\data\ActiveDataFilter;
use yii\db\Query;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use yii\filters\AccessControl;

class ProductController extends ActiveController
{
    public $modelClass = Product::class;

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {
        $mpn = Yii::$app->request->get('mpn', false);
        $name = Yii::$app->request->get('name', false);
        $brand_id = Yii::$app->request->get('brand_id', false);
        $product_id = Yii::$app->request->get('product_id', false);

        if (empty($mpn) && empty($name) && empty($brand_id) && empty($product_id)) {
            return new ActiveDataProvider([
                'query' => Product::find()
            ]);
        }

        if (!empty($mpn)) {
            return new ActiveDataProvider([
                'query' => Product::find()->andWhere(['mpn' => \Yii::$app->request->get('mpn')])
            ]);
        }

        if (!empty($name)) {
            return new ActiveDataProvider([
                'query' => Product::find()->andWhere(['name' => \Yii::$app->request->get('name')])
            ]);
        }

        if (!empty($product_id)) {
            return new ActiveDataProvider([
                'query' => Product::find()->andWhere(['product_id' => \Yii::$app->request->get('product_id')])
            ]);
        }

        if (!empty($brand_id)) {
            return new ActiveDataProvider([
                'query' => Product::find()->andWhere(['brand_id' => \Yii::$app->request->get('brand_id')])
            ]);
        }
    }
}


