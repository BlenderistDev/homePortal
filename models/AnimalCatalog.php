<?php

namespace app\models;

use app\models\Animal;
use yii\data\ActiveDataProvider;

class AnimalCatalog extends Catalog
{


    public static function getDataProviderByAnimal($animal_id){
        $query = static::find()
        ->where(['animal_id'=>$animal_id])
        ->all();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>5,
            ],
        ]);
    }

    public static function Add($array){
        $name = trim($array['name']);
        if (strlen($name)<3){
            return;
        }
        $obj= new Static();
        $obj->name=$name;
        $obj->animal_id = Animal::getId($array['animal']);
        $obj = $obj->hasSame();
        $obj->save();
    }
    public static function Edit($array,$s=""){
        $name = trim($array['name']);
        if (strlen($name)<3){
            return;
        }
        $obj= Static::find()
        ->where(['id'=>$array['id']])
        ->one();
        $obj->name=$name;
        $obj->animal_id = Animal::getId($array['animal']);
        $obj->save();
    }
    public static function getListByAnimal($animal_id){
        $array = [];
        $query = static::find()
        ->where(['animal_id'=>$animal_id])
        ->select(['name'])
        ->asArray()
        ->all();
        foreach ($query as $value){
            $array[]=$value['name'];
        }
        return $array;
    }

}
    

?>