<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
        'user_id',
        'currency_id',
        'currency',
        'quote_key',
        'total',
        'start_date',
        'end_date',
    ];

    protected $appends = ['formatted_created_at', 'formatted_start_date'];

    /**
     * Format created at.
     *
     * @return string
     */
    public function getFormattedCreatedAtAttribute(): string
    {
        return date('Y F d', strtotime($this->created_at));
    }

    /**
     * Format start date.
     *
     * @return string
     */
    public function getFormattedStartDateAttribute(): string
    {
        return date('Y F d', strtotime($this->start_date));
    }

    /**
     * Get the currency associated with the quotation. this no need coz im storing currency_id directly for this test purposes. :)
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
