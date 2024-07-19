<?php

namespace App\Models;

use App\Observers\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use HasFactory, UsesUuid;

    protected $connection = 'mysql';

    protected $table = 'media';
}
