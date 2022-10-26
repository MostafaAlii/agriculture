<?php
namespace App\Models;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Worker extends Authenticatable {
    use HasFactory, Notifiable, HasImage;
    protected $table = "workers";
    protected $guarded = [];
    public $timestamps = true;
          public function country()
          {
              return $this->belongsTo(Country::class, 'country_id');
          }
          public function province()
          {
              return $this->belongsTo(Province::class, 'province_id');
          }
          public function area()
          {
              return $this->belongsTo(Area::class, 'area_id');
          }
          public function state()
          {
              return $this->belongsTo(State::class, 'state_id');
          }
          public function village()
          {
              return $this->belongsTo(Village::class, 'village_id');
            }
            public function currency(): HasOne {
                return $this->hasOne(Currency::class,'id','currency_id');
            }
}