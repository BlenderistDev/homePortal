<?php $this->beginContent('@app/views/layouts/main.php'); ?>

<div class="freezerHeader">
<?php
    $header_links=[
        'Запасы'=>'/basic/web/index.php?r=freezer/freezer',
        'Добавление'=>'/basic/web/index.php?r=freezer/index',
        'Справочники'=>'/basic/web/index.php?r=freezer/catalogs',
    ];
    foreach($header_links as $key => $value){
        $str="<span><a href=\"$value\" class=\"freezerHeaderButton\">$key</a></span>";
        print $str;
    }
?>
</div>

<?= $content ?>

<?php $this->endContent(); ?>