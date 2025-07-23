<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
        'currency_id',
        'currency',
        'quote_key',
        'total'
    ];

    /**
     * Get the currency associated with the quotation.
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
