<?php

use yii\grid\GridView;
use yii\jui\AutoComplete;

$token = Yii::$app->request->getCsrfToken();

function makeList($animal,$animalAddList){
    $token = Yii::$app->request->getCsrfToken();
    $select = "<select name = \"type\"><option value=\"food\">Корм</option><option value=\"consumables\">Расходники</option></select>";
    $str="<table>";
    foreach($animalAddList as $key => $value){
        if ($value['animal']==$animal){
            $form="<form method = \"post\" action = \"/basic/web/index.php?r=animal/list-unknown-add\">$select<input type=\"hidden\" name=\"animal\" value=\"$animal\"><input type=\"hidden\" name=\"id\" value=\"$key\"><input type=\"hidden\" name=\"name\" value=\"$value[animalList]\"><input type=\"hidden\" name=\"count\" value=\"$value[count]\"><input type=\"hidden\" name=\"_csrf\" value=\"$token\"><input type=\"submit\" value=\"add\"></form>";
            $str.="<tr><td>$value[animalList]</td><td>$value[count]</td><td>$form</td></tr>";
        }
    }
    $str.="</table>";
    return $str;
}
print "<div class=\"content\">";
foreach($animalList as $value){
    $list=$animalStuffList[$value];
    $autocomplete = AutoComplete::widget([
        'name' => 'animalList',
        'clientOptions' => [
            'source' => $list,
            'class' => 'productListName',
        ],
    ]);
    $unknown = makeList($value,$animalAddList);
    print "<div class = 'animalBlock'>";
    print "<div class =\"animalBlockHeader\">$value</div>";
    print GridView::widget([
        'dataProvider'=>$animalDataProviders[$value]['food'],
        'options' => ['class'=>$value."Table"],
        'summary' => "корм",
        'columns' => [
            [
                'attribute' => 'name',
                'label' => 'Название',
                'value' => 'name',
                // 'contentOptions' =>['class' => 'freezerTd'],
            ],
            [
                'attribute' => 'count',
                'label' => 'Количество',
                'value' => 'count',
                // 'contentOptions' =>['class' => 'freezerTd'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'controller'=>'animal',
                // 'header' => 'Количество',
                'contentOptions' =>['class' => 'animalTdButtons'],
                'template'=>'{view1}',
                'buttons'=>[
                    'view1' => function ($url, $model, $key) {
                        // var_dump($model);
                        $id = $model['id'];
                        return '<form method="post" class = "AnimalControl" action = "index.php?r=animal/food-change"><input type="hidden" name="animal" value="$value"><input type="submit" name="act" value="+" class="AnimalControlFormButton"><input type="submit" name="act" value="-" class="AnimalControlFormButton"><input type="text" class="AnimalControlFormText" name = "count" value="1"><input type = "hidden" name = "id" value="'.$id.'"><input type="hidden" name="_csrf" value="'.Yii::$app->request->getCsrfToken().'"></form>';
                    }
                ],
                
            ],
        ]
    ]);
    print GridView::widget([
        'dataProvider'=>$animalDataProviders[$value]['consumables'],
        'options' => ['class'=>$value."Table"],
        'summary' => "расходники",
        'columns' => [
            [
                'attribute' => 'name',
                'label' => 'Название',
                'value' => 'name',
                // 'contentOptions' =>['class' => 'freezerTd'],
            ],
            [
                'attribute' => 'count',
                'label' => 'Количество',
                'value' => 'count',
                // 'contentOptions' =>['class' => 'freezerTd'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'controller'=>'animal',
                // 'header' => 'Количество',
                'contentOptions' =>['class' => 'animalTdButtons'],
                'template'=>'{view1}',
                'buttons'=>[
                    'view1' => function ($url, $model, $key) {
                        // var_dump($model);
                        $id = $model['id'];
                        return '<form method="post" class = "AnimalControl" action = "index.php?r=animal/consumables-change"><input type="hidden" name="animal" value="$value"><input type="submit" name="act" value="+" class="AnimalControlFormButton"><input type="submit" name="act" value="-" class="AnimalControlFormButton"><input type="text" class="AnimalControlFormText" name = "count" value="1"><input type = "hidden" name = "id" value="'.$id.'"><input type="hidden" name="_csrf" value="'.Yii::$app->request->getCsrfToken().'"></form>';
                    }
                ],
                
            ],
        ]
    ]);
    print<<<_HTML_
    <form method = "post" action="/basic/web/index.php?r=animal/list-add">
    $autocomplete<input type="text" class="addCount" name="count" value="1"><button type=submit name="animal" class="submit" value=$value>+</button><input type="hidden" name="_csrf" value="$token"> 
    </form>
    $unknown
_HTML_;
    print "<br>";
    print "</div>";
}
print "</div>";

