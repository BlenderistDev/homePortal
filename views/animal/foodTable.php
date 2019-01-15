<?php //Вывод справочника корма

use yii\grid\GridView;
use app\models\Animal;


$addForm = $this->render('foodAdd',[
    'model'=>$model,
    'animalList'=>$animalList,
]);

print GridView::widget([
    'dataProvider'=>$foodDataProvider,
    'filterModel' => $animalFoodSearchModel,
    'options' => ['class'=>'foodTable'],
    'columns' => [ 
        [ 
            
            'header' => '№',
            'class' => 'yii\grid\SerialColumn',
            'contentOptions' =>['class' => 'freezerTdSerial'],
        ],
        [
            'attribute' => 'name',
            'label' => 'Название',
            'value' => 'name',
        ],
        [
            'attribute' => 'animalName',
            'label' => 'животное',
            'value' => 'animalName',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => $addForm,
            'controller'=>'animal',
            'template'=>'{editFood}',
            'buttons'=>[
                'editFood' => function ($url, $mod, $key) use ($model,$animalList) {
                    return $this->render('foodEdit',[
                        'animalList'=>$animalList,
                        'id'=>$key,
                        'foodName'=>$mod->name,
                        'animal'=>Animal::getName($mod->animal_id),
                        'model'=>$model,
                    ]);
                }
            ],
        ],
 
       
     
    ]
]);
?>