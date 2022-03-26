<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shiprocket_token extends Model
{
    use HasFactory;
    protected $table = "shiprocket_tokens";
    protected $primaryKey = 'id';
    public $timestamps = false;

}
