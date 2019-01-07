<?php // вывод таблицы хранилищ

use yii\grid\GridView;

$addForm = $this->render('storageAdd');
print GridView::widget([
    'dataProvider'=>$productStorageDataProvider,
    'options' => ['class'=>'storageTable'],
    'columns' => [
        'name',
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => $addForm,
            'controller'=>'freezer',
            'template'=>'{editStorage}',
            'buttons'=>[
                'editStorage' => function ($url, $model, $key) {
                    return $this->render('storageEdit',[
                        'id'=>$key,
                        'storageName'=>$model->name,
                    ]);
                }
            ],
        ],
    ]
]);