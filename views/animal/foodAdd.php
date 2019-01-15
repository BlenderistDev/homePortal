<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Modal;

Modal::begin([
    'header' => '<h2>Добавление корма</h2>',
    'toggleButton' => ['label' => '+'],
]);
$form = ActiveForm::begin([
    'id' => 'addAnimalFoodForm',
    'options' => ['class' => 'addAnimalFoodForm'],
    'action'=>'/basic/web/index.php?r=animal/animal-food-add',
    'method'=>'post'
]);
$model->name = "";
print $form->field($model, 'name')->label("Название корма");
print $form->field($model, 'animal')->label("Животное")->dropDownList($animalList);
?>
<div class="submitButton">
    <?= Html::submitButton('Добавить корм', ['class' => 'addButton','name'=>'act','value'=>'add']) ?>
</div>
<?php ActiveForm::end(); 
Modal::end();
?>