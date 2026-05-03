<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = ['institution', 'degree', 'year_from', 'year_to', 'description'];

    protected $table = 'education';
}
