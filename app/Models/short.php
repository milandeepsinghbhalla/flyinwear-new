<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class short extends Model
{
    use HasFactory;
    protected $table = "shorts";
    protected $primaryKey = 'id';
    public $timestamps = false;
}
