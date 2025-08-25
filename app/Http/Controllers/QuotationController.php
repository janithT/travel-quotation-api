<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\QuoteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\QuotationRequest;

class QuotationController extends Controller
{

    public function __construct(public QuoteService $quoteService)
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {

        $quotations = $this->quoteService->getQuotations($request);

        if ($quotations->status) {
            return apiResponseWithStatusCode($quotations->data, 'success', $quotations->message, '', 200);
        } else {
            Log::error('Quotation retrieval failed: ' . $quotations->message);
            return apiResponseWithStatusCode([], 'error', $quotations->message, '', 422);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(QuotationRequest $request) :JsonResponse
    {

        $quote = $this->quoteService->createQuotation($request->validated());

        if ($quote->status) {
            return apiResponseWithStatusCode($quote->data, 'success', $quote->message, '', 200);
        } else {
            Log::error('Quotation creation failed: ' . $quote->message . ' | Request Data: ' . json_encode($request->validated()));
            return apiResponseWithStatusCode([], 'error', $quote->message, '', 422);
        }
    }
}
