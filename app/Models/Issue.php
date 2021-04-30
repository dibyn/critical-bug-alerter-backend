<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Issue extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'status',
        'created_at'
    ];

    // public $timestamps = false;

    public function getStatusAttribute($value){
        return ucwords($value);
    }   

    public function getCreatedAtAttribute($value) {
        return (new Carbon($value))->diffForHumans();
    }
}
