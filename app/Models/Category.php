<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory , SoftDeletes;

    protected  $fillable=['name','parent_id','image','status','slug','description'];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id' )
                ->withDefault();
    }
    public function child()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id' );
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function scopeFilter(Builder $builder,$filters){
        $builder->when($filters['name'] ?? false,function($builder,$value){
            $builder->where('name','like',"%{$value}%");
        });
        $builder->when($filters['status'] ?? false,function($builder,$value){
            $builder->whereStatus($value);
        });

    }
}
