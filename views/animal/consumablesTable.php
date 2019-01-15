<?php //Вывод справочника расходников

use yii\grid\GridView;
use app\models\Animal;

$addForm = $this->render('consumablesAdd',[
    'model'=>$model,
    'animalList'=>$animalList,
]);

print GridView::widget([
    'dataProvider'=>$consumablesDataProvider,
    'filterModel' => $animalConsumablesSearchModel,
    'options' => ['class'=>'consumablesTable'],
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
            'template'=>'{editConsumables}',
            'buttons'=>[
                'editConsumables' => function ($url, $mod, $key) use ($model,$animalList) {
                    return $this->render('consumablesEdit',[
                        'animalList'=>$animalList,
                        'id'=>$key,
                        'consumablesName'=>$mod->name,
                        'animal'=>Animal::getName($mod->animal_id),
                        'model'=>$model,
                    ]);
                }
            ],
        ],
 
       
     
    ]
]);
?>