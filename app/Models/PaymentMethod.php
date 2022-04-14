<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class PaymentMethod extends Model {
    use HasFactory;
    protected $table = "payment_methods";
    protected $guarded = [];
    public $timestamps = true;
}
