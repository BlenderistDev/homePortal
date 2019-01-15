<?php

namespace app\models;

use yii\data\ActiveDataProvider;

class Animal extends Catalog
{
    public function rules()
    {
        return [
            [['name','id'],'safe'],
            [['name'],'string'],
            [['id'],'integer'],
        ];
    }
    public static function tableName()
    {
        return 'animal';
    }

    public static function getAllDataProviders(){
        $animalArray = Self::getList();
        $array=[];
        foreach($animalArray as $value){
            $animal_id = Self::getId($value);
            $array[$value]['food'] = AnimalFoodStorage::getAnimalDataProvider($animal_id);
            $array[$value]['consumables'] = AnimalConsumablesStorage::getAnimalDataProvider($animal_id);
        }
        return $array;
    }

    public static function getStuffList(){
        $animalArray = Self::getList();  
        $array=[];
        foreach($animalArray as $value){
            $list = [];
            $animal_id = Self::getId($value);
            $foodArray = AnimalFood::getListByAnimal($animal_id);
            $consumablesArray = AnimalConsumables::getListByAnimal($animal_id);
            $list = array_merge($list,$foodArray,$consumablesArray);
            $array[$value]=$list;
        }
        return $array;  
    }

    public static function checkAdd($animalName,$stuff,$count){
        if($id = AnimalFood::getId($stuff)){
            AnimalFoodStorage::add($id,$count);
        }
        else if($id = AnimalConsumables::getId($stuff)){
            AnimalConsumablesStorage::add($id,$count);
        }
        else{
            return false;
        }
        return true;
    }

    public static function newStuf($name,$animal,$type,$count){
        if ($type === "food"){
            AnimalFood::add(['name'=>$name,'animal'=>$animal]);
            $id = AnimalFood::getId($name);
            AnimalFoodStorage::add($id,$count);
        }
        else if ($type === "consumables"){
            AnimalConsumables::add(['name'=>$name,'animal'=>$animal]);
            $id = AnimalConsumables::getId($name);
            AnimalConsumablesStorage::add($id,$count);
        }
        else{
            return false;
        }
        return true;


    }


}
    

?>