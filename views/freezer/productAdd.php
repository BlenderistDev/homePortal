<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use app\models\FreezerAddForm;

Modal::begin([
    'header' => '<h2>Добавление продукта в справочник</h2>',
    'toggleButton' => ['label' => '+'],
]);
$form = ActiveForm::begin([
    'id' => 'addProductForm',
    'options' => ['class' => 'addProductForm'],
    'action'=>'/basic/web/index.php?r=freezer/add-new-product',
    'method'=>'post'
]);
print $form->field($model, 'productName')->label("Название продукта");
print $form->field($model, 'productCategory')->label("Категория")->dropDownList($categoryList);
print $form->field($model, 'productStorage')->label("Хранилище")->dropDownList($storageList);
?>
<div class="submitButton">
    <?= Html::submitButton('Добавить продукт', ['class' => 'addButton','name'=>'act','value'=>'add']) ?>
</div>
<?php ActiveForm::end(); 
Modal::end();
?>