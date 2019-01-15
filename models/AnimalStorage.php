<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

class AnimalStorage extends ActiveRecord
{
    public static function add($id,$count){
        $obj = static::find()
        ->where(['id'=>$id])
        ->one();
        if ($obj === null){
            $obj = new Static;
            $obj->id = $id;
            $obj->count = $count;
        }
        else{
            $obj->count += $count;
        }
        if ($obj->count > 0){
            $obj->save();
        }
        else{
            $obj->delete();
        }

    }
}
?>