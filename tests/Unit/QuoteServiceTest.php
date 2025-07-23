<?php

namespace Tests\Unit;

use App\Models\Ageload;
use App\Models\Currency;
use App\Models\Quotation;
use Tests\TestCase;
use App\Services\QuoteService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuoteServiceTest extends TestCase
{

    use RefreshDatabase;

    public function test_it_creates_a_quotation_successfully()
    {
        // fake test currency data
        Currency::factory()->create([
            'currency_id' => 'EUR',
            'fixed_rate' => 3.0,
        ]);

        // fake test ageload data
        Ageload::factory()->createMany([
            ['min_age' => 18, 'max_age' => 30, 'load' => 0.6],
            ['min_age' => 31, 'max_age' => 40, 'load' => 0.7],
        ]);

        $service = new QuoteService(new Currency(), new Ageload(), new Quotation());

        $data = [
            'age' => [28, 35],
            'start_date' => '2020-08-01',
            'end_date' => '2020-08-30',
            'currency_id' => 'EUR',
        ];

        $response = $service->createQuotation($data);

        $this->assertTrue($response->status);
        $this->assertEquals('Quotation created successfully', $response->message);
        $this->assertNotEmpty($response->data['id']);
        $this->assertEquals('EUR', $response->data['currency_id']);
        $this->assertEquals('117.00', $response->data['total']); // I'm testing with the assignment/test sample total = 117
    }
}
