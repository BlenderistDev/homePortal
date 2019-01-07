<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

class Catalog extends ActiveRecord
{
    public function getList(){
        $list =[];
        $query = static::find()
        ->select('name')
        ->asArray()
        ->all();
        foreach($query as $value){
            $list[$value['name']]=$value['name'];
        }
        return $list;
    }
    public static function Add($name){
        $name = trim($name);
        if (strlen($name)<3){
            return;
        }
        $obj= new Static();
        $obj->name=$name;
        $obj = $obj->hasSame();
        $obj->save();
    }
    protected function hasSame(){
        $name=$this->name;
        $obj = static::find()
        ->where(['name'=>$name])
        ->one();
        if($obj === null){
            return $this;
        }
        else{
            return $obj;
        }
    }
    public static function edit($name,$id){
        $name=trim($name);
        if (strlen($name)<3){
            return;
        }
        $obj = static::find()
        ->where("id=$id")
        ->one();
        if ($name!==$obj->name){
            $obj->name = $name;
            $obj->save();
        }
    }
    public static function getDataProvider(){
        $query = static::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>10,
            ],
        ]);
        return $dataProvider;
    }
    public static function getId($name){
        $obj = static::find()
        ->where(['name'=>$name])
        ->select('id')
        ->one();
        return $obj->id;
    }
    public static function getName($id){
        $name = static::find()
        ->where(['id'=>$id])
        ->select('name')
        ->one();
        return $name->name;
    }
    public static function tableName()
    {
        die('function tableName not relised');
    }
}

?>