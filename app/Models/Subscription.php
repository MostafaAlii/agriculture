<?php
namespace App\Models;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Subscription extends Model {
    use HasFactory;
    protected $table = "subscriptions";
    protected $guarded = [];
    public $timestamps = true;
    protected $casts = ['subscription_end_date' => 'datetime:Y/m/d'];
    protected $dates = ['subscription_end_date'];


    //subscription for this mails is stoped
    public function scopeExpireSubscribeDate($query) {
        return $query->where('subscription_end_date','<' ,Carbon::today());
    }

    
    //this mails still subscribe with recent updates
    public function scopeOnlyNotExpiredDate($query) {
        return $query->where('subscription_end_date','>=' ,Carbon::today());
    }
}
