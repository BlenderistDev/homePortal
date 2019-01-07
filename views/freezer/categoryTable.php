<?php // вывод таблицы категорий

use yii\grid\GridView;

$addForm = $this->render('categoryAdd');
print GridView::widget([
    'dataProvider'=>$productCategoryDataProvider,
    'options' => ['class'=>'categoryTable'],
    'columns' => [
        'name',
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => $addForm,
            'controller'=>'freezer',
            'template'=>'{editCategory}',
            'buttons'=>[
                'editCategory' => function ($url, $mod, $key) use ($model) {
                    return $this->render('categoryEdit',[
                        'id'=>$key,
                        'categoryName'=>$mod->name,
                        'model'=>$model,
                    ]);
                }
            ],
        ],
    ]
]);
?>