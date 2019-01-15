<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Modal;

Modal::begin([
    'header' => '<h2>Добавление расходника</h2>',
    'toggleButton' => ['label' => '++'],
]);
$form = ActiveForm::begin([
    'id' => 'addStorageForm',
    'options' => ['class' => 'addStorageForm'],
    'action'=>'/basic/web/index.php?r=animal/list-add1',
    'method'=>'post'
]);
print $form->field($model, 'name')->label("Тип");
?>
<div class="submitButton">
    <?= Html::submitButton('Добавить', ['class' => 'addButton','name'=>'act','value'=>'add']) ?>
</div>
<?php ActiveForm::end(); 
Modal::end();
?>