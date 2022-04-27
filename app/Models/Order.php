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
    protected $casts = [
        'delivered_date' => 'datetime:Y/m/d',
        'canceled_date' => 'datetime:Y/m/d',
    ];

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

    public function getStatusForExport() {
        switch ($this->status) {
            case 'ordered': $result = trans('Admin/orders.ordered') ; break;
            case 'delivered': $result = trans('Admin/orders.deliverd') ; break;
            case 'canceled': $result = trans('Admin/orders.canceled') ; break;
        }
        return $result;
    }

    public function scopeSearch($query, $term) {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('referance_id', 'like', $term)
            ->orWhere('subtotal', 'like', $term)
            ->orWhere('total', 'like', $term)
            ->orWhere('discount', 'like', $term)
            ->orWhere('delivered_date', 'like', $term);
        });
    }
}
