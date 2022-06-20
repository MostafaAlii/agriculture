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
    //const PENDING = 'pending', APPROVED = 'approved', DECLINED = 'declined', REFUNDED = 'refunded';
    const ORDERED = 0, DELIVERED = 1, UNDER_PROCESS = 2, FINISHED = 3, REJECTED = 4, CANCELED = 5,
          REFUNDED_REQUEST = 6, REFUNDED = 7, PUSH_FROM_STOCK = 8, THANK_YOU = 9, CURRENCY = 'USD';

    public function order(): BelongsTo {
        return $this->belongsTo(Order::class);
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

    public function getStatusForPrint() {
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

    public function getTransaction() {
        switch ($this->mode) {
            case 'cod': $result = '<label class="badge badge-success">'. trans('Admin/orders.cash_on_delivery') .'</label>'; break;
            case 'card': $result = '<label class="badge badge-primary">'. trans('Admin/orders.card') .'</label>'; break;
            case 'paypal': $result = '<label class="badge bg-dark text-white">'. trans('Admin/orders.byPayPal') .'</label>'; break;
        }
        return $result;
    }

    public function getTransactionForPrint() {
        switch ($this->mode) {
            case 'cod': $result = trans('Admin/orders.cash_on_delivery'); break;
            case 'card': $result = trans('Admin/orders.card'); break;
            case 'paypal': $result = trans('Admin/orders.byPayPal'); break;
        }
        return $result;
    }
}
