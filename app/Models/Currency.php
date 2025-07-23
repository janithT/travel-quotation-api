<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory;
    
    protected $fillable = ['currency_id', 'fixed_rate'];


     /**
     * Get currency fix rates.
     *
     */

    public function getCurrencyFixRates(int|string $currency): Currency|false
    {
        $currency = $this->select('id', 'fixed_rate')->where('currency_id', $currency)->first();

        if (!$currency) {
            throw new \InvalidArgumentException('Currency not found.');
        }

        return $currency;
    }
}
