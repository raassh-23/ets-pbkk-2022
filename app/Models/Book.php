<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'synopsis',
        'cover_image',
        'isbn',
        'publish_year',
        'edition',
        'writer_id',
        'publisher_id',
        'category_id',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function writers()
    {
        return $this->belongsToMany(Writer::class);
    }

    public function getRatingAttribute()
    {
        return $this->reviews->avg('rating');
    }
}
