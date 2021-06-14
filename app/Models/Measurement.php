<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Measurement extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'measurements';
    protected $guarded = ['id', 'created_at'];

    public static function boot() {
        parent::boot();
        static::updating(function($entity){
            $entity->updated_by = Auth::id();
            $entity->updated_at = Carbon::now();
        });
        static::deleting(function($entity){
            $entity->deleted_by = Auth::id();
        });
    }

    public function sensor() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Sensor::class);
    }
}
