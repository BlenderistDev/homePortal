<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Modal;

Modal::begin([
    'header' => '<h2>Изменение животного</h2>',
    'toggleButton' => ['label' => 'edit'],
]);
$form = ActiveForm::begin([
    'id' => 'EditAnimalForm',
    'options' => ['class' => 'EditAnimalForm'],
    'action'=>'/basic/web/index.php?r=animal/animal-edit',
    'method'=>'post'
]);
$model->name=$animalName;
$model->id=$id;
print $form->field($model, 'name')->label("Имя");
print $form->field($model, 'id')->hiddenInput()->label("");
?>
<div class="submitButton">
    <?= Html::submitButton('Изменить животное', ['class' => 'addButton']) ?>
</div>
<?php ActiveForm::end(); 
Modal::end();
?>