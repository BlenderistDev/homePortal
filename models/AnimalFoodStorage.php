<?php

namespace app\models;
use yii\data\ActiveDataProvider;
use yii\data\AnimaleFood;

class AnimalFoodStorage extends AnimalStorage
{
    public function getAnimalFood()
    {
        return $this->hasOne(AnimalFood::className(),['id'=>'id']);
    }
    public static function getAnimalDataProvider($id){
        $query = static::find()
        ->joinWith('animalFood')
        ->where(['animal-food.animal_id'=>$id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>5,
            ],
        ]);
        $dataProvider->sort->attributes['name'] = [
            'asc' => ['name' => SORT_ASC],
            'desc' => ['name' => SORT_DESC],
        ];
        return $dataProvider;
    }
    public static function tableName()
    {
        return 'animal-food-storage';
    }
    public function getName(){
        return $this->animalFood->name;
    }

    // public static function getDataProvider(){
    //     $query = static::find();
    //     $dataProvider = new ActiveDataProvider([
    //         'query' => $query,
    //         'pagination'=>[
    //             'pageSize'=>10,
    //         ],
    //     ]);
    //     return $dataProvider;
    // }

}
?>