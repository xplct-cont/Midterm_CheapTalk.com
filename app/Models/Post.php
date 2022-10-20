<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('m-d-Y');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('m-d-Y');
    }

    public function scopeSearch($query, $terms)
    {
        collect(explode(" ", $terms))
        ->filter()
        ->each(function($term) use($query){
            $term = '%'. $term . '%';

            $query->where('name', 'LIKE', $term)
                ->orWhere('categories','LIKE', $term);
        });
    }
}
