<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Sensor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sensors';
    protected $guarded = ['id', 'created_at', 'created_by'];
    protected $hidden = ['api_key'];
    public $incrementing = false;

    /**
     * @var mixed|string
     */
    public static function boot(){
        parent::boot();
        static::creating(function($entity){
            $entity->id = Str::uuid();
            $entity->created_by = Auth::id();
        });
        static::updating(function($entity){
            $entity->updated_by = Auth::id();
            $entity->updated_at = Carbon::now();
        });
        static::deleting(function($entity){
            $entity->deleted_by = Auth::id();
        });
    }

    public function user() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function measurements(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Measurement::class);
    }
}
