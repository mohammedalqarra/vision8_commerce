<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class , 'parent_id')->withDefault();// في حال حذفت العنصر إلي معه ما يعطيني error
    }

    public function children()
    {
        return $this->hasMany(Category::class , 'parent_id');// كل الأبناء إلي مع ال parent
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
