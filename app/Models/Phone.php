<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Phone extends Model
{
    use HasFactory;

    protected $table = 'phone';
    protected $fillable = ["name","date_id"];

    public function nicknames():HasMany{
        return $this->hasMany(Nickname::class);
    }
}
