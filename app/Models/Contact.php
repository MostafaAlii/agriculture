<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Contact extends Model {
    use HasFactory,Translatable;
    protected $table = "contact_us";
    protected $guarded = [];
    public $translatedAttributes = [];
    public $timestamps = true;
}
