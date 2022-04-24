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

    public function getStatus() {
        switch ($this->status) {
            case 'pending': $result = '<label class="badge badge-warning">'. trans('Admin/orders.pending_order') .'</label>'; break;
            case 'approved': $result = '<label class="badge badge-primary">'. trans('Admin/orders.approved_order') .'</label>'; break;
            case 'declined': $result = '<label class="badge badge-danger">'. trans('Admin/orders.declined_order') .'</label>'; break;
            case 'refunded': $result = '<label class="badge bg-dark text-white">'. trans('Admin/orders.refunded_order') .'</label>'; break;
        }
        return $result;
    }

    public function getStatusForPrint() {
        switch ($this->status) {
            case 'pending': $result = trans('Admin/orders.pending_order'); break;
            case 'approved': $result = trans('Admin/orders.approved_order'); break;
            case 'declined': $result = trans('Admin/orders.declined_order'); break;
            case 'refunded': $result = trans('Admin/orders.refunded_order'); break;
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
