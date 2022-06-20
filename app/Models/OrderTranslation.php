<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class OrderTranslation extends Model {
    use HasFactory;
    protected $table = "order_translations";
    protected $fillable = ['reason'];
    public $timestamps = false;
}
