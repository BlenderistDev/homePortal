<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\ProductCategory;
use app\models\ProductStorage;
use app\models\Frezeer;

class Products extends Catalog
{
  
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name'], 'string'],
            [['id','name','category_id','categoryName'],'safe'],
        ];
    }  
    public function getCategory()
    {
        return $this->hasOne(ProductCategory::className(),['id'=>'category_id']);
    }
    public function getStorage()
    {
        return $this->hasOne(productStorage::className(),['id'=>'storage_id']);
    }
    public function getStorageName()
    {
        return $this->storage->name;
    }
    public function getCategoryName()
    {
        return $this->category->name;
    }
    public static function add($options = [])
    {
        $name = trim($options['name']);
        $category = $options['category'];
        $storage = $options['storage'];
        if (strlen($name)<3){
            return;
        }
        $product = new Products();
        $product->name=$name;
        $product = $product->hasSame();
        $product->category_id = ProductCategory::getId($category);
        $product->storage_id = ProductStorage::getId($storage);
        $product->save();
    }
    public static function tableName()
    {
        return 'products';
    }
    public static function edit($name,$options=[])
    {
        $name = trim($name);
        if (strlen($name)<3){
            return;
        }
        $id = $options['id'];
        $category_id = ProductCategory::getId($options['category']);
        $storage_id = ProductStorage::getId($options['storage']);
        $product = self::find()
        ->where(['id'=>$id])
        ->one();
        if ($product->name != $name){
            $product->name=$name;
        }
        if ($product->category_id != $category_id){
            $product->category_id=$category_id;
        }
        if ($product->storage_id != $storage_id){
            $product->storage_id=$storage_id;
        }
        $product->save();
    }
    public static function explodeProductArray($str){
        if($str===''){
            return [];
        }
        $productList = explode(',',$str);
        foreach($productList as &$value){
            $value = explode('&',$value);
        }
        return $productList;
    }

    private static function implodeProductArray($productList)
    {
        foreach($productList as &$value){
            $value = implode("&",$value);
        }
        return implode(',',$productList);
    }
    public static function checkProduckListName($productList, $name)
    {
        foreach($productList as $key => $value){
            if (in_array($name,$value)){
                return $key;
            }
        }
        return false;
    }
    public static function checkProduct($product,$productStr)
    {
        $productList = self::explodeProductArray($productStr);
        $name = strip_tags(trim($product['productListName']));
        $count = $product['count'];
        if ((mb_strlen($name)<3)||(!is_numeric($count))){//валидация данных
            return self::implodeProductArray($productList);
        }
        if (($key = self::checkProduckListName($productList,$name))!==false){
            $productList["$key"][1]+=$count;
        }
        else{
            $newProduct = self::find()
            ->where(['name'=>$name])
            ->one();
            if ($newProduct === null){
                $productList[]=[$name,$count];
            }
            else{
                $productList[]=[$newProduct->name,$count,$newProduct->categoryName,$newProduct->storageName];
            }
        }
        return self::implodeProductArray($productList);
    }
    public static function checkProductList($productStr,$post)
    {
        $productList = self::explodeProductArray($productStr);
        foreach($productList as $key => $value){
            $newProduct = self::find()
            ->where(['name'=>$value[0]])
            ->one();
            if ($newProduct !== null){
                Freezer::controlForm([
                    'model_id'=>$newProduct->id,
                    'count'=>$value[1],
                    'act'=>'+',
                ]);
                unset($productList[$key]);
            }
            else{
                $categoryKey = str_replace(' ','_',$value[0])."_category";
                $storageKey = str_replace(' ','_',$value[0])."_storage";
                if ((array_key_exists($categoryKey,$post)) && (array_key_exists($storageKey,$post))){
                    self::add([
                        'name'=>$value[0],
                        'category'=>$post[$categoryKey],
                        'storage'=> $post[$storageKey]
                    ]);
                    Freezer::controlForm([
                        'model_id'=>self::getId($value[0]),
                        'count'=>$value[1],
                        'act'=>'+',
                    ]);
                    unset($productList[$key]);
                }
            }
        }
        return self::implodeProductArray($productList);
    }
    public static function removeFromProductList($productStr,$id)
    {
        $productList = self::explodeProductArray($productStr);
        $productList[$id][1]-=1;
        if($productList[$id][1]===0){
            unset($productList[$id]);
        }
        return self::implodeProductArray($productList);
    }
}

?>