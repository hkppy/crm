<?php

namespace app\admin\model;

use think\Model;

class Apilist extends Model
{
    protected $autoWriteTimestamp = true;
    protected $auto = ['title', 'url'];
    protected function setTitleAttr($value)
    {
        return strtolower($value);
    }
}
