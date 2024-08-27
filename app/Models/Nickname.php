<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nickname extends Model
{
    use HasFactory;

    protected $table = 'nickname';
    protected $fillable = ["nickname","date_id","phone_id","chip"];
}
