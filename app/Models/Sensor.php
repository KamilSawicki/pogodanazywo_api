<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    protected $table = 'sensors';
    protected $guarded = ['id', 'created_at', 'created_by'];
    protected $hidden = ['api_key'];
    public $incrementing = false;

    public function user() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function measurements(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Measurement::class);
    }
}
