<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Modal;

Modal::begin([
    'header' => '<h2>Изменение корма</h2>',
    'toggleButton' => ['label' => 'edit'],
]);
$form = ActiveForm::begin([
    'id' => 'editAnimalFoodForm',
    'options' => ['class' => 'editAnimalFoodForm'],
    'action'=>'/basic/web/index.php?r=animal/animal-food-edit',
    'method'=>'post'
]);
$model->name = $foodName;
$model->animal = $animal;
$model->id = $id;
print $form->field($model, 'name')->label("Название продукта");
print $form->field($model, 'animal')->label("Животное")->dropDownList($animalList);
print $form->field($model, 'id')->hiddenInput()->label("");
?>
<div class="submitButton">
    <?= Html::submitButton('Изменить корм', ['class' => 'addButton','name'=>'act','value'=>'edit']) ?>
</div>
<?php
ActiveForm::end(); 
Modal::end();
?>