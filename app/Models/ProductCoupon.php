<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;
use Illuminate\Support\Str;
class ProductCoupon extends Model {
    use HasFactory;
    protected $table = "product_coupons";
    protected $guarded = [];
    protected $dates = ['start_date', 'expire_date'];
    public $timestamps = true;
    const ACTIVE = 1, DISACTIVE = 0, LIMIT = 20, DOLLAR = '$', PRESENTAGE = '%';
    // Coupon Has One Farmer
    public function user(): BelongsTo {
        return $this->belongsTo(Farmer::class);
    }
    public function limit() {
        return Str::limit($this->description, self::LIMIT);
    }

    public function valueTypeSwitch() {
        return $this->type == 'fixed' ? self::DOLLAR : self::PRESENTAGE;
    }

    public function useTimeCustomized() {
        return $this->used_times . ' / ' . $this->use_times;
    }

    public function startEndDateCustomized() {
        return $this->start_date != ' ' ? $this->start_date->format('Y-m-d') . ' _ ' . $this->expire_date->format('Y-m-d') : '-';
    }
    public  function getStatus(){
        return $this->status == self::DISACTIVE ?  trans('Admin\coupons.not_active') : trans('Admin\coupons.active');
     }

    public function scopeCouponsWithUser($query) {
        return $query->with('user:id,firstname,lastname')->get();
    }

    public function discount($total) {
        if (!$this->checkDate() || !$this->checkUsedTimes()){
            return 0;
        }
        return $this->checkGreaterThan($total) ? $this->doCalcProcess($total) : 0;
    }

    protected function checkDate() {
        return $this->expire_date != '' ? (Carbon::now()->between($this->start_date, $this->expire_date, true)) ? true : false : true;
    }

    protected function checkUsedTimes() {
        return $this->use_times != '' ? ( $this->use_times > $this->used_times ) ? true : false : true;
    }

    protected function checkGreaterThan($total) {
        return $this->greater_than != '' ? ($this->greater_than >= $total) ? true : false : true;
    }

    protected function doCalcProcess($total) {
        switch ($this->type) {
            case 'fixed':
                return $this->value;
            case 'percentage':
                return ($this->value / 100) * $total;
            default:
                return 0;
        }
    }
}