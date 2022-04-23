<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class capery extends Model
{
    use HasFactory;
    protected $table = "caperies";
    protected $primaryKey = 'id';
    public $timestamps = false;

}
