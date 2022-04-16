<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class PaymentMethod extends Model {
    use HasFactory;
    protected $table = "payment_methods";
    protected $guarded = [];
    public $timestamps = true;

    public function status() {
        return $this->status ? 'Active' : 'Inactive';
    }

    public function sandbox() {
        return $this->sandbox ? 'Sandbox' : 'Live';
    }

    public function orders(): HasMany {
        return $this->hasMany(Order::class);
    }
}
