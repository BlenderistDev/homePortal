<?php

namespace app\models;

class AnimalConsumables extends AnimalCatalog
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
        return 'animal-consumables';
    }
    public function getAnimal()
    {
        return $this->hasOne(Animal::className(),['id'=>'animal_id']);
    }
    public function getAnimalName()
    {
        return $this->animal->name;
    }
}
    

?>