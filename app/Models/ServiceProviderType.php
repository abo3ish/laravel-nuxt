<?php

namespace App\Models;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceProviderType extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'slug',
        'profit_percentage'
    ];

    const DOCTOR = 'doctor';
    const NURSE = 'nurse';
    const DELIVERY = 'delivery';

    public function discount()
    {
        return $this->morphOne(Discount::class, 'discountable');
    }

    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }
}
