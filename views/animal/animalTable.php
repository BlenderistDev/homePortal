<?php // вывод таблицы категорий

use yii\grid\GridView;

$addForm = $this->render('animalAdd',[
    'model'=>$model,
]);
print GridView::widget([
    'dataProvider'=>$AnimalDataProvider,
    'options' => ['class'=>'animalTable'],
    'columns' => [
        [ 
            
            'header' => '№',
            'class' => 'yii\grid\SerialColumn',
            'contentOptions' =>['class' => 'freezerTdSerial'],
        ],
        'name',
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => $addForm,
            'controller'=>'animal',
            'template'=>'{editCategory}',
            'buttons'=>[
                'editCategory' => function ($url, $mod, $key) use ($model) {
                    return $this->render('animalEdit',[
                        'id'=>$key,
                        'animalName'=>$mod->name,
                        'model'=>$model,
                    ]);
                }
            ],
        ],
    ]
]);
?>