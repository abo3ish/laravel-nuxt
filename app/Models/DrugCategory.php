<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DrugCategory extends Model
{
    protected $fillable = ['title', 'description', 'icon','slug', 'status', 'section_id'];

}
