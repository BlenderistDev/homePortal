<?php

namespace app\models;

class ProductStorage extends Catalog 
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
        return 'product-storage';
    }
}
    

?>