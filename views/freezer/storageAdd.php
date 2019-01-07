<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use app\models\FreezerAddForm;

Modal::begin([
    'header' => '<h2>Добавление хранилища</h2>',
    'toggleButton' => ['label' => '+'],
]);
$form = ActiveForm::begin([
    'id' => 'addStorageForm',
    'options' => ['class' => 'addStorageForm'],
    'action'=>'/basic/web/index.php?r=freezer/storage-add',
    'method'=>'post'
]);
$model = new FreezerAddForm();
print $form->field($model, 'name')->label("Название хранилища");
?>
<div class="submitButton">
    <?= Html::submitButton('Добавить хранилище', ['class' => 'addButton','name'=>'act','value'=>'add']) ?>
</div>
<?php ActiveForm::end(); 
Modal::end();
?>