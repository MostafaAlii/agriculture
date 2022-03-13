<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Admin extends Authenticatable {
    use HasFactory, Notifiable;
    protected $table = "admins";
    protected $guarded = [];
    public $timestamps = true;

        // rel
        public function image()
        {
            return $this->morphOne(Image::class, 'imageable');
        }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
