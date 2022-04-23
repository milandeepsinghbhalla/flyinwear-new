<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class round_neck extends Model
{
    use HasFactory;
    protected $table = "round_necks";
    protected $primaryKey = 'id';
    public $timestamps = false;
}
