<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ProductSearch extends Products
{
    public $categoryName;
    public $storageName;
    
    public function rules()
    {

        return [
            [['name', 'id','categoryName','storageName'], 'safe'],
        ];
    }
    
    public function search($params)
    {
        $query = Products::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        $dataProvider->sort->attributes['categoryName'] = [
            'asc' => ['name' => SORT_ASC],
            'desc' => ['name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['storageName'] = [
            'asc' => ['name' => SORT_ASC],
            'desc' => ['name' => SORT_DESC],
        ];
        if (!($this->load($params) && $this->validate())) {
            $query->joinWith(['category'])->joinWith('storage');
            return $dataProvider;
        }
        $query->joinWith('category')->joinWith('storage');
        $query->andFilterWhere(['like','products.name', $this->name]);
        $query->andFilterWhere(['like','product-category.name', $this->categoryName]);
        $query->andFilterWhere(['like','product-storage.name', $this->storageName]);
        return $dataProvider;
    }
}
?>