<?php
//Вывод справочника продуктов
print $this->render('productCatalog',[
    'model'=>$model,
    'categoryList'=>$categoryList,
    'storageList'=>$storageList,
    'productDataProvider'=>$productDataProvider,
    'productSearchModel' => $productSearchModel,
]);
// вывод таблицы категорий
print $this->render('categoryTable',[
    'model'=>$model,
    'productCategoryDataProvider'=>$productCategoryDataProvider,
]);
// вывод таблицы хранилищ
print $this->render('storageTable',[
    'productStorageDataProvider'=>$productStorageDataProvider,
]);
?>