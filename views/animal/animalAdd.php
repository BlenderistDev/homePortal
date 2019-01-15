<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Modal;

Modal::begin([
    'header' => '<h2>Добавление животного</h2>',
    'toggleButton' => ['label' => '+'],
]);
$form = ActiveForm::begin([
    'id' => 'addAnimalForm',
    'options' => ['class' => 'addAnimalForm'],
    'action'=>'/basic/web/index.php?r=animal/animal-add',
    'method'=>'post'
]);
print $form->field($model, 'name')->label("Название животного");
?>
<div class="submitButton">
    <?= Html::submitButton('Добавить животное', ['class' => 'addButton','name'=>'act','value'=>'add']) ?>
</div>
<?php ActiveForm::end(); 
Modal::end();
?>