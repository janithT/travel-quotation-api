<?php

namespace App\Services;

use App\Models\Ageload;
use App\Models\Currency;
use App\Models\Quotation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class QuoteService
{
    /**
     * Create a new QuoteService instance.
     *
     * @param Currency $currencyModel
     * @param Ageload $ageloadModel
     * @param Quotation $quotationModel
     */
    public function __construct(
        public Currency $currencyModel, 
        public Ageload $ageloadModel, 
        public Quotation $quotationModel) 
    {

    }


    /**
     * Create a new quotation.
     *
     * @param array $data
     * @return Quotation
     */
    public function createQuotation(array $data): object
    {
        DB::beginTransaction();

        try {
            $ages = $data['age'];

            // gettravel days
            $startDate = Carbon::parse($data['start_date']);
            $endDate = Carbon::parse($data['end_date']);
            $travelDays = $startDate->diffInDays($endDate) + 1;

            // if fixed_rate is common for each currency, so may be config value. (currenty im getting from database)
            $getCurrency = $this->currencyModel->getCurrencyFixRates($data['currency_id']);
            // here im calculating total.
            $calculateTotal = $this->calculateTotal($ages, $getCurrency->fixed_rate, $travelDays);

            $output = $this->quotationModel->create([
                'currency_id' => $getCurrency->id,
                'currency' => $data['currency_id'],
                'quote_key' => generateQuoteKey('QTN-'),
                'total' => $calculateTotal
            ]);

            DB::commit();

            $result =  [
                'id' => $output->id,
                'currency_id' => $output->currency,
                'total' => number_format($output->total, 2),
            ];
            return apiServiceResponse($result, true, 'Quotation created successfully');

        } catch (\Throwable $th) {
            DB::rollBack();
            return apiServiceResponse([], false, $th->getMessage());

        }
    }

    /**
     * Calculate the total.
     *
     */
    private function calculateTotal(array $ages, float $getCurrencyFixRates, int $travelDays): float|false
    {
        $ageLoads = $this->ageloadModel->all();

        //  $total = 0;

        // foreach ($ages as $age) {
            // this will be little latency and call eloquent multiple times. :) :)  
        // }

        $totalArray = collect($ages)
            ->map(function ($age) use ($getCurrencyFixRates, $travelDays, $ageLoads) {
                $ageLoad = $ageLoads->first(function ($item) use ($age) {
                    return $item->min_age <= $age && $item->max_age >= $age;
                });

                return ($getCurrencyFixRates * $ageLoad->load * $travelDays);
            });
            // $total = array_sum($totalArray);
        $total = $totalArray->sum();

        if ($total <= 0) {
            throw new \RuntimeException("Total amount calculated invalid.");
        }

        return $total;
    }
}
