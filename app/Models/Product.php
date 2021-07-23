<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Product extends Model
{
    use HasFactory;


    protected $fillable = [
           'title', 
           'slug', 
           'description', 
           'fimage', 
           'status', 
           'category_id', 
           'gallary'
       ];




    protected static function boot(){
        parent::boot();
     
        static::created(function ($Product) {
            $Product->slug = $Product->createSlug($Product->title);
            $Product->save();
        });


    }


    public static function createSlug($title){
           $slug = Str::slug($title, '-');
           $count = Product::where('slug', 'LIKE', "{$slug}%")->count();
           $newCount = $count > 0 ? ++$count : '';
           return $newCount > 0 ? "$slug-$newCount" : $slug;
    }


    public function categories(){
        return $this->hasMany(ProductCategories::class);
    }

    public function images(){
        return $this->hasMany(ProductImage::class);
    }
}
