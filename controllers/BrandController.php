<?php

namespace app\controllers;

use app\models\Brand;
use app\models\BrandSearch;
use app\models\Product;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class BrandController extends ActiveController
{
    public $modelClass = Brand::class;

    /*public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {

        return new ActiveDataProvider([
            'query' => Product::find()->andWhere(['name' => \Yii::$app->request->get('name')])
        ]);
    }

   /* public function prepareDataProvider()
    {

        return new ActiveDataProvider([
            'query' => Product::find()->andWhere(['brand_id' => \Yii::$app->request->get('brand_id')])
        ]);
    }*/
   /* public function actionIndex()
    {
        $searchModel = new BrandSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return new ActiveDataProvider([
        'query' => Product::find()->andWhere(['mpn' => \Yii::$app->request->get('mpn')])
    ]);
    }*/
}