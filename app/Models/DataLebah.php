<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataLebah extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function panen()
    {
        return $this->hasMany(Panen::class, 'data_lebah_id', 'id');
    }
    
}
