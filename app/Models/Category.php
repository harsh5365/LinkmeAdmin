<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public static function saveCategory(array $param){
        $cat = new Self();
        $cat->category = $param['category'];
        $cat->save();
        return true;
    }
}
