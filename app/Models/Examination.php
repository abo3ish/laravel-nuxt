<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
