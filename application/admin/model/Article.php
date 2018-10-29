<?php

namespace app\admin\model;

use think\Model;

class Article extends Model
{
    protected $autoWriteTimestamp = true;
    
    protected $insert = ['content'];

}
