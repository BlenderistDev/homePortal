<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Modal;

Modal::begin([
    'header' => '<h2>Изменение расходника</h2>',
    'toggleButton' => ['label' => 'edit'],
]);
$form = ActiveForm::begin([
    'id' => 'editAnimalConsumablesForm',
    'options' => ['class' => 'editAnimalConsumablesForm'],
    'action'=>'/basic/web/index.php?r=animal/animal-consumables-edit',
    'method'=>'post'
]);
$model->name = $consumablesName;
$model->animal = $animal;
$model->id = $id;
print $form->field($model, 'name')->label("Название расходника");
print $form->field($model, 'animal')->label("Животное")->dropDownList($animalList);
print $form->field($model, 'id')->hiddenInput()->label("");
?>
<div class="submitButton">
    <?= Html::submitButton('Изменить расходник', ['class' => 'addButton','name'=>'act','value'=>'edit']) ?>
</div>
<?php
ActiveForm::end(); 
Modal::end();
?>