<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Modal;


Modal::begin([
    'header' => '<h2>Изменение категории</h2>',
    'toggleButton' => ['label' => 'edit'],
]);
$form = ActiveForm::begin([
    'id' => 'EditCategoryForm',
    'options' => ['class' => 'EditCategoryForm'],
    'action'=>'/basic/web/index.php?r=freezer/category-control-form',
    'method'=>'post'
]);
$model->productCategory=$categoryName;
$model->id=$id;
print $form->field($model, 'productCategory')->label("Название категории");
print $form->field($model, 'id')->hiddenInput()->label("");
?>
<div class="submitButton">
    <?= Html::submitButton('Изменить категорию', ['class' => 'addButton']) ?>
</div>
<?php ActiveForm::end(); 
Modal::end();
?>