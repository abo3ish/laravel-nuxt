<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExaminationOrder extends Model
{
    protected $fillable = ['user_id', 'examination_service_type_id', 'subtotal_price', 'tax_price', 'discount_price', 'total_price', 'status', 'address_id', 'examiner_id'];


    public function examinationServiceType()
    {
        $this->belongsTo(ExaminationServiceType::class);
    }

    public function calculatePriceToPay($tax = 0, $discount = 0)
    {
        return $this->calaculateSubTotal();
    }

    // Price before tax and discount
    public function calaculateSubTotal()
    {
        return $this->examinationServiceType->estimation_from - $this->examinationServiceType->estimation_to;
    }
}
