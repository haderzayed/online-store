<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected  $fillable=['name','parent_id','image','status','slug','description'];
    
    public function parent()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
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
