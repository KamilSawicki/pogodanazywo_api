<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    use HasFactory;

    protected $table = 'measurements';
    protected $guarded = ['id', 'created_at'];

    public function sensor() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Sensor::class);
    }
}
