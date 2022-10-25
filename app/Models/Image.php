<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Image extends Model {
    use HasFactory;
    protected $fillable =['filename','imageable_id','imageable_type'];
    public function imageable() {
        return $this->morphTo();
    }

    protected static function boot() {
        parent::boot();
        static::deleting(function ($image){
            if(static::where('filename', $image->filename)->exists()) {
                Storage::disk('public')->delete($image->filename);
            }
        }); 
    }
}