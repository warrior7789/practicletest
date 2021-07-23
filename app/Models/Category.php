<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{   
    protected $table = 'categorys'; 
    use HasFactory;


    protected $fillable = [
           'title', 'status', 'slug'
       ];


    protected static function boot(){
        parent::boot();
     
        static::created(function ($Category) {
            $Category->slug = $Category->createSlug($Category->title);
            $Category->save();
        });


    }


    public static function createSlug($title){
           $slug = Str::slug($title, '-');
           $count = Category::where('slug', 'LIKE', "{$slug}%")->count();
           $newCount = $count > 0 ? ++$count : '';
           return $newCount > 0 ? "$slug-$newCount" : $slug;
    }   

}
