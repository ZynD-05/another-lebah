<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panen extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function dataLebah()
    {
        return $this->belongsTo(DataLebah::class, 'data_lebah_id', 'data_lebah_id');
    }
}
