<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use app\models\FreezerAddForm;

Modal::begin([
    'header' => '<h2>Добавление категории</h2>',
    'toggleButton' => ['label' => '+'],
]);
$form = ActiveForm::begin([
    'id' => 'EditCategoryForm',
    'options' => ['class' => 'EditCategoryForm'],
    'action'=>'/basic/web/index.php?r=freezer/category-add',
    'method'=>'post'
]);
$model = new FreezerAddForm();
print $form->field($model, 'productCategory')->label("Название категории");
?>
<div class="submitButton">
    <?= Html::submitButton('Добавить категорию', ['class' => 'addButton','name'=>'act','value'=>'add']) ?>
</div>
<?php ActiveForm::end(); 
Modal::end();
?>