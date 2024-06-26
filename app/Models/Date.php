<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    protected $fillable = [
        'id',
        'date',
        'coverimage',
        'status'
    ];
}
