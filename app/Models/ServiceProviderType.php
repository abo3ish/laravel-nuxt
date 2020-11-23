<?php

namespace App\Models;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Model;

class ServiceProviderType extends Model
{
    protected $fillable = [
        'title',
        'description',
        'slug'
    ];

    public function discount()
    {
        return $this->morphOne(Discount::class, 'discountable');
    }
}
