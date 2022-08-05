<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $table = "files";
    protected $fillable = ['name','size','file','path','full_file','mime_type','file_type','relation_id'];

    public $timestamps = true;
}
