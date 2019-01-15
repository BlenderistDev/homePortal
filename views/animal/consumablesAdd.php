<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Modal;

Modal::begin([
    'header' => '<h2>Добавление расходника</h2>',
    'toggleButton' => ['label' => '+'],
]);
$form = ActiveForm::begin([
    'id' => 'addAnimalConsumablesForm',
    'options' => ['class' => 'addAnimalFoodForm'],
    'action'=>'/basic/web/index.php?r=animal/animal-consumables-add',
    'method'=>'post'
]);
$model->name = "";
print $form->field($model, 'name')->label("Название расходника");
print $form->field($model, 'animal')->label("Животное")->dropDownList($animalList);
?>
<div class="submitButton">
    <?= Html::submitButton('Добавить расходник', ['class' => 'addButton','name'=>'act','value'=>'add']) ?>
</div>
<?php ActiveForm::end(); 
Modal::end();
?>