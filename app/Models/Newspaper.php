<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newspaper extends Model
{
    protected $fillable = [
        'id',
        'papers',
        'newsid',
        'sequence',
        'status'
    ];
}
