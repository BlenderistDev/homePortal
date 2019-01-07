<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class FreezerSearch extends Freezer
{
    public $name;
    public $categoryName;
    public $storageName;

    public function rules()
    {
        return [
            [['id', 'name','count','categoryName','storageName'], 'safe'],
        ];
    }
    public function search($params)
    {
        $query = Freezer::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        $dataProvider->sort->attributes['name'] = [
            'asc' => ['products.name' => SORT_ASC],
            'desc' => ['products.name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['categoryName'] = [
               'asc' => ['product-category.name' => SORT_ASC],
               'desc' => ['product-category.name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['storageName'] = [
            'asc' => ['product-storage.name' => SORT_ASC],
            'desc' => ['product-storage.name' => SORT_DESC],
        ];
        if (!($this->load($params) && $this->validate())) {
            $query->joinWith(['products']);
            return $dataProvider;
        }
        $query->joinWith(['products'])
        ->andFilterWhere(['like','products.name', $this->name])
        ->andFilterWhere(['like','product-category.name', $this->categoryName])
        ->andFilterWhere(['like','product-storage.name', $this->storageName]);

        return $dataProvider;
    }
}
?>