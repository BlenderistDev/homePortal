<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use app\models\FreezerAddForm;

Modal::begin([
    'header' => '<h2>Изменение продукта</h2>',
    'toggleButton' => ['label' => 'edit'],
]);
$form = ActiveForm::begin([
    'id' => 'editProductForm',
    'options' => ['class' => 'editProductForm'],
    'action'=>'/basic/web/index.php?r=freezer/product-edit',
    'method'=>'post'
]);
$model->productName = $productName;
$model->productCategory = $categoryName;
$model->id = $id;
print $form->field($model, 'productName')->label("Название продукта");
print $form->field($model, 'productCategory')->label("Категория")->dropDownList($categoryList);
print $form->field($model, 'productStorage')->label("Хранилище")->dropDownList($storageList);
print $form->field($model, 'id')->hiddenInput()->label("");;
?>
<div class="submitButton">
    <?= Html::submitButton('Изменить продукт', ['class' => 'addButton','name'=>'act','value'=>'edit']) ?>
</div>
<?php ActiveForm::end(); 
Modal::end();
?>