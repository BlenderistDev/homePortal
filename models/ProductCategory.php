<?php

namespace app\models;

class ProductCategory extends Catalog
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
        return 'product-category';
    }
}
    

?>