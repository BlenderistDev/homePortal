<?php

namespace app\models;

use yii\data\ActiveDataProvider;

class AnimalConsumablesStorage extends AnimalStorage
{
    public function getAnimalConsumables()
    {
        return $this->hasOne(AnimalConsumables::className(),['id'=>'id']);
    }
    public static function getAnimalDataProvider($id){
        $query = static::find()
        ->joinWith('animalConsumables')
        ->where(['animal-consumables.animal_id'=>$id]);
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
        return 'animal-consumables-storage';
    }
    public function getName(){
        return $this->animalConsumables->name;
    }
}
?>