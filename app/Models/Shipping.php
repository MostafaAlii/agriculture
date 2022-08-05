<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Shipping extends Model {
    use HasFactory;
    protected $table = "shippings";
    protected $guarded = [];
    public $timestamps = true;

    public function order(): BelongsTo {
        return $this->belongsTo(Order::class);
    }
}
