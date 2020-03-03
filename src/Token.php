<?php
namespace devskyfly\mgp;

use yii\base\BaseObject;

class Token extends BaseObject
{
    public $value = "";
    public $expire = 0;
    public $refreshValue = "";
    public $tokenType = "";
}