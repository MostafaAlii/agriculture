<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class OrderTransaction extends Model {
    use HasFactory;
    protected $table = "order_transactions";
    protected $fillable = ['order_id', 'transaction', 'transaction_number', 'payment_result'];
    public $timestamps = true;
}
