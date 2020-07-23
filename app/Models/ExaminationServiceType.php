<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExaminationServiceType extends Model
{
    protected $fillable = ['title', 'icon', 'parent_id', 'examination_service_id', 'estimation_from', 'estimation_to'];

    public function examinationService()
    {
        return $this->belongsTo(ExaminationService::class);
    }

    public function childs()
    {
        return $this->hasMany(Self::class, 'parent_id');
    }

    public function getPriceAttribute()
    {
        return ($this->estimation_from + $this->estimation_to) / 2;
    }
}
