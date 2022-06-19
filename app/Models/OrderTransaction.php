<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class OrderTransaction extends Model {
    use HasFactory;
    protected $table = "order_transactions";
    protected $fillable = ['order_id', 'transaction', 'transaction_number', 'payment_result'];
    public $timestamps = true;
    const ORDERED = 0, DELIVERED = 1, UNDER_PROCESS = 2, FINISHED = 3, REJECTED = 4,
          CANCELED = 5, REFUNDED_REQUEST = 6, RETURNED = 7, REFUNDED = 8, CURRENCY = 'USD';

    public function order(): BelongsTo {
        return $this->belongsTo(Order::class);
    }
}
