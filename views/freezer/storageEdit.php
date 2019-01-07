<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use app\models\FreezerAddForm;

Modal::begin([
    'header' => '<h2>Изменение хранилища</h2>',
    'toggleButton' => ['label' => 'edit'],
]);
$form = ActiveForm::begin([
    'id' => 'EditStorageForm',
    'options' => ['class' => 'EditStorageForm'],
    'action'=>'/basic/web/index.php?r=freezer/storage-edit',
    'method'=>'post'
]);
$model = new FreezerAddForm();
$model->name=$storageName;
$model->id=$id;
print $form->field($model, 'name')->label("Название хранилища");
print $form->field($model, 'id')->hiddenInput()->label("");
?>
<div class="submitButton">
    <?= Html::submitButton('Изменить хранилище', ['class' => 'addButton']) ?>
</div>
<?php ActiveForm::end(); 
Modal::end();
?>