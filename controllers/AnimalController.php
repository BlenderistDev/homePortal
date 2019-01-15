<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\AnimalFood;
use app\models\Animal;
use app\models\AnimalConsumables;
use app\models\FreezerAddForm;
use app\models\animalFoodSearch;
use app\models\AnimalFoodStorage;
use app\models\AnimalConsumablesStorage;
use app\models\AnimalConsumablesSearch;

use yii\web\Cookie;

class AnimalController extends Controller{

    public $layout = 'animal';

    public function actionIndex(){

        $animalList = Animal::getList();
        $animalStuffList = Animal::getStuffList();
        // $foodDataProviderArray = AnimalFood::getAllFoodDataProviders();
        // $consumablesDataProviderArray = AnimalConsumables::getAllFoodDataProviders();
        $animalDataProviders = Animal::getAllDataProviders();
        $form_model = new FreezerAddForm;

        $cookiesReq = Yii::$app->request->cookies;
        $animalAddList = unserialize($cookiesReq->getValue('animalList', ''));

        if(!$animalAddList){
            $animalAddList = [];
        }

        return $this->render('index',[
            'animalDataProviders'=>$animalDataProviders,
            'animalList' => $animalList,
            'animalAddList' => $animalAddList,
            'animalStuffList' => $animalStuffList,
            // 'foodDataProviderArray'=>$foodDataProviderArray,
            // 'consumablesDataProviderArray'=>$consumablesDataProviderArray,
            // 'animalFoodDataProvider'=>$animalFoodDataProvider,
            'model'=>$form_model,
        ]);
    }
    public function actionCatalogs()
    {
        $animalList = Animal::getList();
        $animalFoodSearchModel = new AnimalFoodSearch();
        $foodDataProvider = $animalFoodSearchModel->search(Yii::$app->request->get());

        $animalConsumablesSearchModel = new AnimalConsumablesSearch();
        $consumablesDataProvider = $animalConsumablesSearchModel->search(Yii::$app->request->get());

        $AnimalDataProvider = Animal::getDataProvider();

        $form_model = new FreezerAddForm;
        return $this->render('catalogs',[
            'animalFoodSearchModel'=>$animalFoodSearchModel,
            'AnimalDataProvider'=>$AnimalDataProvider,
            'foodDataProvider'=>$foodDataProvider,
            'consumablesDataProvider'=>$consumablesDataProvider,
            'animalConsumablesSearchModel'=>$animalConsumablesSearchModel,
            'animalList'=>$animalList,
            'model'=>$form_model,
        ]);

    }
    public function actionListAdd()
    {
        $request = Yii::$app->request;
        $cookiesReq = Yii::$app->request->cookies;
        $cookiesRes = Yii::$app->response->cookies;
        $animalList = $cookiesReq->getValue('animalList', '');
        $post=$request->post();
        if(!Animal::checkAdd($post['animal'],$post['animalList'],$post['count'])){
            $animalList = unserialize($animalList);
            $array=[
                'animal' => $post['animal'],
                'count' => $post['count'],
                'animalList'=>$post['animalList']
            ];
            $animalList[]=$array;
            $animalList = serialize($animalList);
        }
        $cookiesRes->add(new Cookie([
            'name' => 'animalList',
            'value' => $animalList,
        ]));
        return $this->redirect('@web/index.php?r=animal/index'); 
    }
    public function actionListUnknownAdd()
    {
        $request = Yii::$app->request;
        $cookiesReq = Yii::$app->request->cookies;
        $cookiesRes = Yii::$app->response->cookies;
        $animalList = $cookiesReq->getValue('animalList', '');
        $post=$request->post();
        if(Animal::newStuf($post['name'],$post['animal'],$post['type'],$post['count'])){
            $animalList = unserialize($animalList);
            unset($animalList[$post['id']]);
            $animalList = serialize($animalList);
        }
        $cookiesRes->add(new Cookie([
            'name' => 'animalList',
            'value' => $animalList,
        ]));
        return $this->redirect('@web/index.php?r=animal/index'); 
    }

    public function actionAnimalAdd()
    {
        $request = Yii::$app->request;
        $post=$request->post()['FreezerAddForm'];
        Animal::Add($post['name']);
        return $this->redirect('@web/index.php?r=animal/catalogs'); 
    }
    public function actionAnimalEdit()
    {
        $request = Yii::$app->request;
        $post=$request->post()['FreezerAddForm'];
        Animal::edit($post['name'],$post['id']);
        return $this->redirect('@web/index.php?r=animal/catalogs'); 
    }
    

    public function actionFoodChange()
    {
        $request=Yii::$app->request;
        $post = $request->post();
        if ($post['act']==='+'){
            $count = $post['count'];
        }
        elseif($post['act']==='-')
        {
            $count = -$post['count'];
        }
        AnimalFoodStorage::add($post['id'],$count);
        return $this->redirect('@web/index.php?r=animal/index'); 
        // var_dump($post);
    }
    public function actionConsumablesChange()
    {
        $request=Yii::$app->request;
        $post = $request->post();
        if ($post['act']==='+'){
            $count = $post['count'];
        }
        elseif($post['act']==='-')
        {
            $count = -$post['count'];
        }
        AnimalConsumablesStorage::add($post['id'],$count);
        return $this->redirect('@web/index.php?r=animal/index');

    }
    public function actionAnimalFoodAdd()
    {
        $request=Yii::$app->request;
        $post = $request->post()['FreezerAddForm'];
        AnimalFood::add([
            'name'=>$post['name'],
            'animal'=>$post['animal'],
        ]);
        return $this->redirect('@web/index.php?r=animal/catalogs');
    }
    public function actionAnimalFoodEdit()
    {
        $request=Yii::$app->request;
        $post = $request->post()['FreezerAddForm'];
        AnimalFood::edit([
            'id'=>$post['id'],
            'name'=>$post['name'],
            'animal'=>$post['animal'],
        ]);
        return $this->redirect('@web/index.php?r=animal/catalogs');
    }
    public function actionAnimalConsumablesEdit()
    {
        // print "hi";
        $request=Yii::$app->request;
        $post = $request->post()['FreezerAddForm'];
        AnimalConsumables::edit([
            'id'=>$post['id'],
            'name'=>$post['name'],
            'animal'=>$post['animal'],
        ]);
        return $this->redirect('@web/index.php?r=animal/catalogs');
    }
    public function actionAnimalConsumablesAdd()
    {
        $request=Yii::$app->request;
        $post = $request->post()['FreezerAddForm'];
        AnimalConsumables::add([
            'name'=>$post['name'],
            'animal'=>$post['animal'],
        ]);
        return $this->redirect('@web/index.php?r=animal/catalogs');
    }
}