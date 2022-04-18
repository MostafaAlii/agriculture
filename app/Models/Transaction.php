<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Transaction extends Model {
    use HasFactory;
    protected $table = "transactions";
    protected $guarded = [];
    public $timestamps = true;
    const COD = 'cod', CARD = 'card', PAYPAL = 'paypal';
    const PENDING = 'pending', APPROVED = 'approved', DECLINED = 'declined', REFUNDED = 'refunded';
    const THANK_YOU = 1;

    public function order(): BelongsTo {
        return $this->belongsTo(Order::class);
    }
}
