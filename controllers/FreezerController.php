<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Freezer;
use app\models\Products;
use app\models\FreezerAddForm;
use app\models\FreezerSearch;
use app\models\ProductSearch;
use app\models\ProductCategory;
use app\models\ProductStorage;
use yii\web\Cookie;

class FreezerController extends Controller
{
    public $layout = 'freezer';

    public function actionIndex()
    {
        $cookies = Yii::$app->request->cookies;
        $selectedProducts = $cookies->getValue('productList','');    
        $categoryList = ProductCategory::getList();
        $storageList = productStorage::getList();
        $productList = Products::getList();

        return $this->render('productList',[
            'productList'=>$productList,
            'selectedProducts'=>$selectedProducts,
            'categoryList' => $categoryList,
            'storageList' => $storageList,
        ]);
    }

    public function actionFreezer()
    {
        $freezerSearchModel = new FreezerSearch();
        $freezerDataProvider = $freezerSearchModel->search(Yii::$app->request->get());
        return $this->render('freezer',[
            'freezerDataProvider'=>$freezerDataProvider,
            'freezerSearchModel'=>$freezerSearchModel,
        ]);
    }

    public function actionCatalogs()
    {
        $productSearchModel = new ProductSearch();
        $productDataProvider = $productSearchModel->search(Yii::$app->request->get());        
        $form_model = new FreezerAddForm;
        $productCategoryDataProvider = ProductCategory::getDataProvider();
        $productStorageDataProvider = ProductStorage::getDataProvider();       
        $categoryList = ProductCategory::getList();
        $storageList = ProductStorage::getList();
        return $this->render('catalogs',[
            'model'=>$form_model,
            'categoryList'=>$categoryList,
            'storageList'=>$storageList,
            'productDataProvider'=>$productDataProvider,
            'productSearchModel'=>$productSearchModel,
            'productCategoryDataProvider'=>$productCategoryDataProvider,
            'productStorageDataProvider'=>$productStorageDataProvider,
        ]);
    }

    public function actionAddNewProduct()
    {
        $request = Yii::$app->request;
        $post=$request->post()['FreezerAddForm'];
        //  Products::addProduct($post['productName'],$post['productCategory'],$post['productStorage']);
        Products::add([
            'name'=>$post['productName'],
            'category'=>$post['productCategory'],
            'storage'=>$post['productStorage']
        ]);
        return $this->redirect('@web/index.php?r=freezer/catalogs');        
    }
    public function actionProductEdit()
    {
        $request = Yii::$app->request;
        $post=$request->post()['FreezerAddForm'];
        Products::edit($post['productName'],[
            'id'=> $post['id'],
            'category' => $post['productCategory'],
            'storage' => $post['productStorage']]);
        return $this->redirect('@web/index.php?r=freezer/catalogs'); 
        
    }
    public function actionControlform()
    {
        $request = Yii::$app->request;
        $post=$request->post();
        Freezer::controlForm($post);
        return $this->redirect('@web/index.php?r=freezer/catalogs'); 
    }
    public function actionCategoryAdd()
    {
        $request = Yii::$app->request;
        $post=$request->post()['FreezerAddForm'];
        ProductCategory::Add($post['productCategory']);
        return $this->redirect('@web/index.php?r=freezer/catalogs'); 
    }
    public function actionCategoryControlForm()
    {
        $request = Yii::$app->request;
        $post=$request->post()['FreezerAddForm'];
        ProductCategory::edit($post['productCategory'],$post['id']);
        return $this->redirect('@web/index.php?r=freezer/catalogs'); 
    }
    public function actionStorageAdd()
    {
        $request = Yii::$app->request;
        $post=$request->post()['FreezerAddForm'];
        ProductStorage::add($post['name']);
        return $this->redirect('@web/index.php?r=freezer/catalogs'); 
    }
    public function actionStorageEdit()
    {
        $request = Yii::$app->request;
        $post=$request->post()['FreezerAddForm'];
        ProductStorage::edit($post['name'],$post['id']);
        return $this->redirect('@web/index.php?r=freezer/catalogs'); 
    }

    public function actionProductList()
    {
        $request = Yii::$app->request;
        $post=$request->post();
        $cookiesReq = Yii::$app->request->cookies;
        $cookiesRes = Yii::$app->response->cookies;
        $productList = $cookiesReq->getValue('productList', '');

        if (isset($post['del'])){
            $productStr = Products::removeFromProductList($productList,$post['del']);
        }
        $productStr;
        if ((isset($post['act'])) && ($post['act']==="addToFreezer")){
            $productStr = Products::checkProductList($productList,$post);
        }
        elseif((isset($post['act'])) && ($post['act']==="+")){
            $productStr = Products::checkProduct($post,$productList);
        } 
        $cookiesRes->add(new Cookie([
            'name' => 'productList',
            'value' => $productStr,
        ]));
        return $this->redirect('@web/index.php?r=freezer/index'); 
    }
}


?>