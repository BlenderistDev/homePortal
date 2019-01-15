<?php $this->beginContent('@app/views/layouts/main.php'); ?>

<div class="animalHeader">
<?php
    $header_links=[
        'Запасы'=>'/basic/web/index.php?r=animal/index',
        'Справочники'=>'/basic/web/index.php?r=animal/catalogs',
    ];
    foreach($header_links as $key => $value){
        $str="<span><a href=\"$value\" class=\"animalHeaderButton\">$key</a></span>";
        print $str;
    }
?>
</div>

<?= $content ?>

<?php $this->endContent(); ?>