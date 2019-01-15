<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class AnimalFoodSearch extends AnimalFood
{
    public $animalName;
    
    public function rules()
    {
        return [
            [['name', 'id','animalName'], 'safe'],
        ];
    }
    
    public function search($params)
    {
        $query = AnimalFood::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        $dataProvider->sort->attributes['animalName'] = [
            'asc' => ['name' => SORT_ASC],
            'desc' => ['name' => SORT_DESC],
        ];
        if (!($this->load($params) && $this->validate())) {
            $query->joinWith(['animal']);
            return $dataProvider;
        }
        $query->joinWith('animal');
        $query->andFilterWhere(['like','animal.name', $this->animalName]);
        $query->andFilterWhere(['like','animal-food.name', $this->name]);
        return $dataProvider;
    }
}
?>