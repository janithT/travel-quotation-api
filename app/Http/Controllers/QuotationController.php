<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\QuoteService;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\QuotationRequest;
use Illuminate\Http\JsonResponse;

class QuotationController extends Controller
{

    public function __construct(public QuoteService $quoteService)
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
