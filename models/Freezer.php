<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use app\models\Products;

class Freezer extends ActiveRecord
{
    public function rules()
    {
        return [
            [['product_id','product_count'], 'integer'],
            [['name','categoryName'], 'safe'],
        ];
    }
    public function getProducts()
    {
        $obj = $this->hasOne(Products::className(),['id'=>'product_id']);
        $obj = $obj->joinWith('category');
        $obj = $obj->joinWith('storage');
        return $obj;
    }
    public function getCategory_id(){
        return $this->products->category_id;  
    }
    public function getStorage_id(){
        return $this->products->storage_id;  
    }
    public function getSpaceTd(){
        return ""; 
    }
    public function getName(){
        return $this->products->name;
    }
    public function getCategoryName(){
          return $this->products->category->name;
    }
    public function getStorageName()
    {
        return $this->products->storage->name;
    }
    private function addToFreezer($id,$count){
        $this->product_id=$id;
        $this->product_count=$count;
        $this->save();
    }
    public static function controlForm(array $post){
        $freezer_str = Freezer::findOne($post['model_id']);
        if ($freezer_str===null){
            $freezer_str = new Freezer();
            $freezer_str->addToFreezer($post['model_id'],$post['count']);
        }
        else if ($post['act']=='+'){
            $freezer_str->updateAddProduct($post['count']);
        }
        else if($post['act']=='-'){
            $freezer_str->removeProduct($post['count']);
        }
    }
    private function updateAddProduct($count){
        $this->product_count+=$count;
        $this->save();
    }
    private static function addProduct(string $name, int $count){
        $freezer = new Freezer();
        $id = Products::getIdByName($name);
        $freezer->product_id = $id;
        $freezer->product_count = $count;
        $freezer->save();
    }
    private function removeProduct(int $count){
        $freezer_count = $this->product_count;
        if ($count >= $freezer_count){
            $this->delete();
            return;
        }
        else{
            $this->product_count=$freezer_count-$count;
            $this->save();
            return;
        }
    }
    public static function tableName()
    {
        return 'freezer';
    }
}
?>