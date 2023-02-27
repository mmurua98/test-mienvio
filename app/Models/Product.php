<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price'
    ];

    //Scope
    public function scopeByName($query, $byName)
    {
        if($byName)
        {
            return $query->where('name', 'LIKE', '%'.$byName.'%');
        }
    }

    public function scopeFilterPrice($query, $min_price, $max_price)
    {
        if($min_price && $max_price)
        {
            return $query->whereBetween('price', [$min_price, $max_price]);
        }
    }

}
