<?php

namespace app\models;

class AnimalFood extends AnimalCatalog
{
    public function rules()
    {
        return [
            [['name','id','animal_id',],'safe'],
            [['name'],'string'],
            [['id','animal_id'],'integer'],
        ];
    }
    public static function tableName()
    {
        return 'animal-food';
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