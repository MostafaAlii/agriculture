<?php
namespace App\Models;
use App\Traits\HasImage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use HasFactory, Notifiable, HasImage;
    protected $table = "users";
    protected $guarded = [];
    public $timestamps = true;
    public $appends = ['image_path'];

    public function country(): BelongsTo {
       return $this->belongsTo(Country::class)->withDefault();
    }

    public function province(): BelongsTo {
       return $this->belongsTo(Province::class)->withDefault();
    }

    public function area(): BelongsTo {
       return $this->belongsTo(Area::class)->withDefault();
    }

    public function state(): BelongsTo {
       return $this->belongsTo(State::class)->withDefault();
    }

    public function village(): BelongsTo {
       return $this->belongsTo(Village::class)->withDefault();
    }

    public function department(): BelongsTo {
       return $this->belongsTo(Department::class)->withDefault();
    }
    public function adminDepartment(): BelongsTo {
        return $this->belongsTo(AdminDepartment::class)->withDefault();
    }
    public function orders(): HasMany {
      return $this->hasMany(Order::class);
   }

   /*************************************************************************************** */
    // Get Vendor Rataing Doing For Product التقييمات الى عملها اليوزر
    public function ratedProducts(): MorphToMany {
        return $this->morphedByMany(Product::class, 'rateable', 'ratings');
    }

    // Get Vendor Rataing Doing For Other Farmer التقييمات الى عملها اليوزر
    public function ratedFarmers(): MorphToMany {
       return $this->morphedByMany(Farmer::class, 'rateable', 'ratings');
   }
   /*************************************************************************************** */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}