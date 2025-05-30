<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KeunggulanItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'subtitle',
    ];
}
