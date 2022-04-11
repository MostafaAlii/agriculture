<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Rating extends Model {
    use HasFactory;
    protected $table = "ratings";
    public $timestamps = true;
    const MIN_STARS_RATE = 1;
}
