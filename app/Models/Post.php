<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * Retrieves the category that this object belongs to.
     *
     * @return BelongsTo A relationship instance.
     */
    public function category(){
        return $this->belongsTo(Category::class);
    }

    /**
     * A description of the entire PHP function.
     *
     * @param $query The query object.
     * @return The query object sorted by 'views' in descending order.
     */
    public function scopeMostviewed($query){
        return $query->orderBy('views', 'desc');
    }

    /**
     * Returns a query builder instance for the 'information' category.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInformation(){
        return $this->with('category')->whereHas('category', function($query){
            $query->where('name', 'information');
        });
    }
}
