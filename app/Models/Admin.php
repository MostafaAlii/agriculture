<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Admin extends Authenticatable {
    use HasFactory, Notifiable;
    protected $table = "admins";
    protected $guarded = [];
    public $timestamps = true;

    // rel
    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function country() {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function province() {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function area() {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function state() {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function village() {
        return $this->belongsTo(Village::class, 'village_id');
    }

    public function department() {
        return $this->belongsTo(Department::class, 'department_id');
    }

    // Admin or Employee Has Many Blogs ::
    public function blogs(): HasMany {
        return $this->hasMany(Blog::class);
    }

        // public function profile(){
        //     return $this->hasOne(Profile::class, 'admin_id');
        //    }
        // attr

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
