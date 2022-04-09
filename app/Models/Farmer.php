<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Farmer extends Authenticatable {
    use HasFactory, Notifiable;
    protected $table = "farmers";
    protected $guarded = [];
    public $timestamps = true;
        // rel
        public function image()
        {
            return $this->morphOne(Image::class, 'imageable');
        }
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
        public function department()
        {
            return $this->belongsTo(Department::class, 'department_id');
        }
        public function products(): HasMany {
            return $this->hasMany(Product::class);
        }
        // Farmer Has Many Coupons ::
        public function coupons(): HasMany {
            return $this->hasMany(ProductCoupon::class);
        }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
