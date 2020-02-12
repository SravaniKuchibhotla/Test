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
        $mpn = Product::find()->andWhere(['mpn' => Yii::$app->request->get('mpn')]);
        $brand_id = Product::find()->andWhere(['brand_id' => Yii::$app->request->get('brand_id')]);
        $name = Product::find()->andWhere(['name' => Yii::$app->request->get('name')]);
        //@todo:: only one condition is working
        /*else if and else not working returning only [].
        only if condition works to display selected mpn's. Try out "http://localhost:8080/Test/web/product/index?mpn=7647623"
        */
        if ($mpn != null) {
            return new ActiveDataProvider([
                'query' => Product::find()->andWhere(['mpn' => Yii::$app->request->get('mpn')])
            ]);
        } elseif ($name != null && empty($name)) {
            return new ActiveDataProvider([
                'query' => Product::find()->andWhere(['name' => Yii::$app->request->get('name')])
            ]);
        } else{
            return new ActiveDataProvider([
                'query' => Product::find()]);
        }
    }
}


