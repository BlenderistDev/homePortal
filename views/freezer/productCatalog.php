<?php //Вывод справочника продуктов

use yii\grid\GridView;
use app\models\ProductCategory;

$productAddForm = $this->render('productAdd',[
    'model'=>$model,
    'categoryList'=>$categoryList,
    'storageList'=>$storageList,
]);

print GridView::widget([
    'dataProvider'=>$productDataProvider,
    'filterModel' => $productSearchModel,
    'options' => ['class'=>'productsTable'],
    'columns' => [        
        [
            'attribute'=>'name',
            'label' => 'Название',
            'value' => 'name',
            'contentOptions' => function ($url, $model, $key){
                return ['class' => 'productCatalog'.$model];
            }
        ],
        [
            'attribute' => 'categoryName',
            'label' => 'Категория',
            'value' => 'categoryName',
        ],
        [
            'attribute' => 'storageName',
            'label' => 'Хранилище',
            'value' => 'storageName',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header'=>$productAddForm,
            'controller'=>'freezer',
            'template'=>'{addToFreezer}{edit}',
            'buttons'=>[
                'addToFreezer' => function ($url, $model, $key) {
                    $id = $model->id;
                    return '<form method="post"  class = "productCatalogAddFrom'.$id.'" action = "index.php?r=freezer/controlform"> <input type="submit" name="act" value="+"><input type="text" size="1" name = "count" value="1" ><input type = "hidden" name = "model_id" value="'.$id.'"><input type="hidden" name="_csrf" value="'.Yii::$app->request->getCsrfToken().'"></form>';
                },
                'edit'=>function ($url, $mod, $key) use ($model,$categoryList,$storageList)
                {
                    return $this->render('productEdit',[
                        'model'=>$model,
                        'categoryList'=>$categoryList,
                        'storageList'=>$storageList,
                        'id'=>$key,
                        'productName'=>$mod->name,
                        'categoryName'=>ProductCategory::getName($mod->category_id),
                    ]);
                }
            ],
        ],
    ]
]);
?>