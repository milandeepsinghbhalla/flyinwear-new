<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ethinic extends Model
{
    use HasFactory;
    protected $table = "ethinics";
    protected $primaryKey = 'id';
    public $timestamps = false;
}
