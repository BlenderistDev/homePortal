<?php
//Вывод справочника животных
print $this->render('animalTable',[
    'AnimalDataProvider'=>$AnimalDataProvider,
    'model'=>$model,
    // 'categoryList'=>$categoryList,
    // 'storageList'=>$storageList,
    // 'productDataProvider'=>$productDataProvider,
    // 'productSearchModel' => $productSearchModel,
]);
// вывод таблицы корма
print $this->render('foodTable',[
    'model'=>$model,
    'foodDataProvider'=>$foodDataProvider,
    'animalFoodSearchModel'=>$animalFoodSearchModel,
    'animalList'=>$animalList,
]);
// вывод таблицы расходников
print $this->render('consumablesTable',[
    'model'=>$model,
    'consumablesDataProvider'=>$consumablesDataProvider,
    'animalConsumablesSearchModel'=>$animalConsumablesSearchModel,
    'animalList'=>$animalList,
]);
?>