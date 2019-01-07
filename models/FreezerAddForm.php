<?php

namespace app\models;

use app\models\Freezer;
//use yii\db\ActiveRecord;

class FreezerAddForm extends Freezer{
    public $productName;
    public $productCategory;
    public $count;
    public $id;
    public $name;
    public $date;
    public $submit;
    public $list;
    public $productStorage;

    public function rules()
    {
        return [

        ];
    }
}