<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class polo extends Model
{
    use HasFactory;
    protected $table = "polos";
    protected $primaryKey = 'id';
    public $timestamps = false;
}
