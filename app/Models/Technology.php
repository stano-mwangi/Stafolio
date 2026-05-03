<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    protected $fillable = ['name', 'category', 'icon_class'];

    protected $table = 'technologies';
}
