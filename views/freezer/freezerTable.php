<?php // вывод запасов

use yii\grid\GridView;

print GridView::widget([
    'dataProvider'=>$freezerDataProvider,
    'filterModel' => $freezerSearchModel,
    'summary' => false,
    'options' => ['class'=>'freezerTable'],
    'tableOptions' => [
        'class' => ''
    ],
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
            'contentOptions' =>['class' => 'freezerTd'],
        ],
        [
            'attribute' => 'categoryName',
            'label' => 'Категория',
            'value' => 'categoryName',
            'contentOptions' =>['class' => 'freezerTd'],
        ],
        [
            'attribute' => 'storageName',
            'label' => 'Хранилище',
            'value' => 'storageName',
            'contentOptions' =>['class' => 'freezerTd'],
        ],
        [
            'attribute' => 'SpaceTd',
            'label' => '',
            'value' => 'SpaceTd',
            'contentOptions' =>['class' => 'freezerSpaceTd'],
        ],
        [
            'attribute' => 'product_count',
            'label' => '_',
            'value' => 'product_count',
            'contentOptions' =>['class' => 'freezerTdCount'],
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'controller'=>'freezer',
            'header' => 'Количество',
            'contentOptions' =>['class' => 'freezerTdButtons'],
            'template'=>'{view1}',
            'buttons'=>[
                'view1' => function ($url, $model, $key) {
                    $id = $model['product_id'];
                    return '<form method="post" class = "FreezerControlForm" action = "index.php?r=freezer/controlform"> <input type="submit" name="act" value="+" class="FreezerControlFormButton"><input type="submit" name="act" value="-" class="FreezerControlFormButton"><input type="text" class="FreezerControlFormText" name = "count" value="1"><input type = "hidden" name = "model_id" value="'.$id.'"><input type="hidden" name="_csrf" value="'.Yii::$app->request->getCsrfToken().'"></form>';
                }
            ],
            
        ],
        [
            'attribute' => 'SpaceTd',
            'label' => '',
            'value' => 'SpaceTd',
            'contentOptions' =>['class' => 'freezerSpaceTd'],
        ],


    ]
]);
?>