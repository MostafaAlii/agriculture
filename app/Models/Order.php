<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{HasMany, BelongsTo, HasOne};
class Order extends Model {
    use HasFactory, Translatable;
    protected $table = "orders";
    protected $guarded = [];
    protected $with=['translations'];
    public $translatedAttributes=['reason'];
    public $timestamps = true;
    const ORDERED = 0, DELIVERED = 1, UNDER_PROCESS = 2, FINISHED = 3, REJECTED = 4,
          CANCELED = 5, REFUNDED_REQUEST = 6, REFUNDED = 7, PUSH_FROM_STOCK = 8, CURRENCY = 'USD';

    protected $casts = [
        'delivered_date'                    => 'datetime:Y/m/d',
        'suggestion_delivered_date'         => 'datetime:Y/m/d',
        'canceled_date'                     => 'datetime:Y/m/d',
        'under_proces_date'                 => 'datetime:Y/m/d',
        'refunded_date'                     => 'datetime:Y/m/d',
        'push_from_stock_date'              =>  'datetime:Y/m/d',
        'reject_date'                       =>  'datetime:Y/m/d',
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
            case 0 : $result = '<label class="badge badge-primary">'.  trans('Admin/orders.ordered')  .'</label>'; break;
            case 1 : $result = '<label class="badge badge-success">'. trans('Admin/orders.deliverd_process') .'</label>'; break;
            case 2 : $result = '<label class="badge badge-default">'. trans('Admin/orders.under_process') .'</label>'; break;
            case 3 : $result = '<label class="badge badge-success">'. trans('Admin/orders.finish') .'</label>'; break;
            case 4 : $result = '<label class="badge badge-danger">'. trans('Admin/orders.reject') .'</label>'; break;
            case 5 : $result = '<label class="badge badge-danger">'. trans('Admin/orders.canceled') .'</label>'; break;
            case 6 : $result = '<label class="badge badge-warning">'. trans('Admin/orders.request_refunded') .'</label>'; break;
            case 7 : $result = '<label class="badge badge-warning">'. trans('Admin/orders.refunded') .'</label>'; break;
            case 8 : $result = '<label class="badge badge-info">'. trans('Admin/orders.push_from_stock') .'</label>'; break;
        }
        return $result;
    }

    public function getStatusForExport() {
        switch ($this->status) {
            case 0 : $result        =          trans('Admin/orders.ordered') ; break;
            case 1 : $result        =          trans('Admin/orders.deliverd_process'); break;
            case 2 : $result        =          trans('Admin/orders.under_process'); break;
            case 3 : $result        =          trans('Admin/orders.finish'); break;
            case 4 : $result        =          trans('Admin/orders.reject'); break;
            case 5 : $result        =          trans('Admin/orders.canceled'); break;
            case 6 : $result        =          trans('Admin/orders.request_refunded'); break;
            case 7 : $result        =          trans('Admin/orders.refunded'); break;
            case 8 : $result        =          trans('Admin/orders.push_from_stock'); break;
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
