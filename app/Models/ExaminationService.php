<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExaminationService extends Model
{
    protected $fillable = ['title', 'description', 'icon'];

    public function examinationServiceTypes()
    {
        return $this->hasMany(ExaminationServiceType::class);
    }

}
