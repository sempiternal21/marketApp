<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdModel extends Model
{
    use HasFactory;
    protected $table = 'ad_models';
    protected $fillable = [
        'author', 'title', 'description', 'price', 'phone', 'imageUrl', 'isSelf'
    ];
}
