<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Astrotomic\Translatable\Translatable;
class User extends Authenticatable {
    use HasFactory, Notifiable;
    protected $table = "users";
    protected $guarded = [];
    // public $translatedAttributes = ['fistname','lastname'];
    public $timestamps = true;
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
