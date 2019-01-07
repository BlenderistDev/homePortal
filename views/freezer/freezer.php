<?php
// вывод запасов
print $this->render('freezerTable',[
    'freezerDataProvider'=>$freezerDataProvider,
    'freezerSearchModel'=>$freezerSearchModel,
]);
?>
