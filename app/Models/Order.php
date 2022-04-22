<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
class Order extends Model {
    use HasFactory;
    protected $table = "orders";
    protected $guarded = [];
    public $timestamps = true;
    const ORDERED = 'ordered', DELIVERED = 'delivered', CANCELED = 'canceled', CURRENCY = 'USD';

    public function currency(): string {
        return $this->currency == 'USD' ? '$' : $this->currency;
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function orderItems(): HasMany {
        return $this->hasMany(OrderItem::class);
    }

    public function shipping(): HasOne {
        return $this->hasOne(Shipping::class);
    }

    public function transaction(): HasOne {
        return $this->hasOne(Transaction::class);
    }

    public function getStatus() {
        switch ($this->status) {
            case 'ordered': $result = '<label class="badge badge-primary">'.  trans('Admin/orders.ordered')  .'</label>'; break;
            case 'delivered': $result = '<label class="badge badge-success">'. trans('Admin/orders.deliverd') .'</label>'; break;
            case 'canceled': $result = '<label class="badge badge-danger">'. trans('Admin/orders.canceled') .'</label>'; break;
        }
        return $result;
    }
}
