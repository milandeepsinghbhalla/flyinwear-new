<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sweat_shirt extends Model
{
    use HasFactory;
    protected $table = "sweat_shirts";
    protected $primaryKey = 'id';
    public $timestamps = false;
}
