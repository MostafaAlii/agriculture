<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = true;


    
    public function commentable()
    {
        return $this->morphTo();
    }
    
    public function childs() {
        return $this->hasMany('App\Models\Comment','parent_id','id') ;
    }
}