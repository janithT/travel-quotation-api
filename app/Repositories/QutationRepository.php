<?php

namespace App\Repositories;

use App\Models\Quotation;
use Illuminate\Support\Collection;

class QutationRepository
{
    /**
     * Get user quotation 
     * 
     */
    public function getAll($perPage, $userId)
    {
        return Quotation::where('user_id', $userId)->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    /**
     * Create user quotation 
     * 
     */
    public function createQuote(array $create_data)
    {
        $conditions = [
            'user_id' => $create_data['user_id'],
            'currency_id' => $create_data['currency_id'],
            'start_date' => $create_data['start_date'],
            'end_date' => $create_data['end_date'],
        ];
        return Quotation::firstOrCreate($conditions, $create_data);
    }
}
