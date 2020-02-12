<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Brand;

class BrandSearch extends Brand
{
    public function rules()
    {
        return [
            [['brand_id'], 'integer'],
            [['logo', 'name', 'updated'], 'safe'],
        ];
    }

    /*public function scenarios()
    {
        return Model::scenarios();
    }*/

    public function search($params)
    {
        $query = Brand::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'brand_id' => $this->brand_id,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
