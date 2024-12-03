<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory , SoftDeletes;
    protected  $fillable=['name','slug','logo_image','cover_image','status' ,'description'];

    public function products(){
        return  $this->hasMany(Product::class);
    }
}
