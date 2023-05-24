<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
class Product extends Model
{
    use HasFactory;

    public function getCategoryIdAttribute()
    {
        $cat = $this->attributes['category_id'];
        $cat_name = [];
        foreach (json_decode($cat) as $category) {

            $category_name = Category::where('id',$category)->first();
            $cat_name[] = $category_name->name;
        }
       return  $cat_name;
    }
}
