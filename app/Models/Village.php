<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
class Village extends Model {
    use HasFactory,Translatable;
    protected $table = "villages";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['name'];
    public $timestamps = true;

    public function state(): BelongsTo {
        return $this->belongsTo(State::class);
    }
}