<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use App\Observers\UsesUuid;

class Provider extends Authenticatable
{
    use HasApiTokens, UsesUuid,HasFactory;

    protected $connection = 'mysql';

    protected $table = 'provider';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
    ];
}