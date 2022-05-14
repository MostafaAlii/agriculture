<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitTranslation extends Model {
    use HasFactory;
    protected $table = "unit_translations";
    protected $fillable = ['Name'];
    public $timestamps = false;
}
