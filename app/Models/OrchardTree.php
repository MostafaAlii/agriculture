<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class OrchardTree extends Model {
    use HasFactory;
    protected $table = "orchard_trees";
    public $timestamps = false;
}
