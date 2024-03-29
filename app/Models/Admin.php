<?php
namespace App\Models;
use App\Traits\HasImage;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Znck\Eloquent\Traits\BelongsToThrough;
class Admin extends Authenticatable {

    use BelongsToThrough,  HasFactory, Notifiable, HasRoles, HasImage;
    
    protected $table = "admins";
    protected $guard = 'admin';
    protected $guarded = [];
    public $timestamps = true;
    public $appends = ['image_path'];
    const ACTIVE = 1, NOT_ACTIVE = 0;

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
    public function adminDepartment() {
        return $this->belongsTo(AdminDepartment::class, 'admin_department_id');
    }

    // Admin or Employee Has Many Blogs ::
    public function blogs(): HasMany {
        return $this->hasMany(Blog::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'roles_name'        =>  'array',
    ];
}