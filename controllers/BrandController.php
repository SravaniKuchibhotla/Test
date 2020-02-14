<?php

namespace app\controllers;

use Yii;
use app\models\Brand;
use app\models\BrandSearch;
use app\models\Product;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class BrandController extends ActiveController
{
    public $modelClass = Brand::class;

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {
        $logo = Yii::$app->request->get('logo', false);
        $name = Yii::$app->request->get('name', false);
        $brand_id = Yii::$app->request->get('brand_id', false);

        if (empty($logo) && empty($name)) {
            return new ActiveDataProvider([
                'query' => Brand::find()
            ]);
        }

        if (!empty($logo)) {
            return new ActiveDataProvider([
                'query' => Brand::find()->andWhere(['logo' => \Yii::$app->request->get('logo')])
            ]);
        }

        if (!empty($name)) {
            return new ActiveDataProvider([
                'query' => Brand::find()->andWhere(['name' => \Yii::$app->request->get('name')])
            ]);
        }

        if (!empty($brand_id)) {
            return new ActiveDataProvider([
                'query' => Brand::find()->andWhere(['brand_id' => \Yii::$app->request->get('brand_id')])
            ]);
        }
    }
}