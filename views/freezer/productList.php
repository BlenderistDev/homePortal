<?php

use yii\jui\AutoComplete;
use app\models\Products;

function makeSelect($array,$name = "select",$text = ""){
    $str = "<select  name=\"$name\" value=\" hi\">";
    $str.= "<option disabled selected>$text</option>";
    foreach($array as $key => $value){
        $str.="<option>$value</option>";
    }
    $str .= "</select>";
    return $str;
}

$autocomplete = AutoComplete::widget([
    'name' => 'productListName',
    'clientOptions' => [
        'source' => $productList,
        'class' => 'productListName',
    ],
]);
$token = Yii::$app->request->getCsrfToken();
$productArray = Products::explodeProductArray($selectedProducts);
$str = "";
if (isset($productArray[0])){
    // $str.="<table><tfoot><tr><td><input type=\"submit\" name=\"act\" value = \"addToFreezer\" text = \"hI\" ></td></tr></tfoot><tbody>";
    $str.="<table><tbody>";
    foreach($productArray as $key => $value){
        $str.="<tr>";
        // $value[1]="<input type=\"text\" size=\"1\" name=\"$value[0]\" value =\"$value[1]\">";
        $delButton = "<button type=\"submit\" name=\"del\" value = \"$key\" class = \"productListDelButton\">-</button>";
        if (count($value)==4){
            $str .= "<td class =\"td0\">$value[0]</td><td class =\"td1\">$value[1]</td><td class =\"td2\">$value[2]</td><td class =\"td3\">$value[3]</td><td class =\"td4\">$delButton</td>";
        }
        elseif(count($value)==2){
            $category = makeSelect($categoryList,$value[0].'_category','категория');
            $storage = makeSelect($storageList,$value[0].'_storage','хранилище');
            $str .= "<td class =\"td0\">$value[0]</td><td class =\"td1\">$value[1]</td><td class =\"td2\">$category</td><td class =\"td3\">$storage</td><td class =\"td4\">$delButton</td>";
        }
        $str.="</tr>";
    }
    $str.="</tbody></table>";
}

print<<<_HTML_
    <div class="productList">
      <form action="/basic/web/index.php?r=freezer/product-list" method="post" class="productListForm">
        $autocomplete<input type="text" class = "productListCount" name="count"><input type="submit" name="act" value = "+" class="productListSubmit"><input type="hidden" name="_csrf" value="$token"> 
        $str
        <p><button type="submit" name="act" value = "addToFreezer">Добавить</button></p>
        </form>
    </div>
_HTML_;
?>
