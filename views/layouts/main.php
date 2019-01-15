<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto&amp;subset=cyrillic,cyrillic-ext" rel="stylesheet">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="header">
<?php
    $header_links=[
        'Запасы'=>'/basic/web/index.php?r=freezer/index',
        'Животные'=>'/basic/web/index.php?r=animal/index',
    ];
    foreach($header_links as $key => $value){
        $str='<span><a href="'.$value.'">'.$key.'</a></span>';
        print $str;
    }
?>
</div>

<?= $content ?>



<footer class="footer">
    <div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
