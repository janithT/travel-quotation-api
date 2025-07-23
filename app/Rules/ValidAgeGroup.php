<?php

namespace App\Rules;

use App\Models\Ageload;
use Illuminate\Contracts\Validation\Rule;

class ValidAgeGroup implements Rule
{
   
    protected array $invalidAges = [];

    public function __construct(public Ageload $ageloadModel)
    {
    }

    // 
    public function passes($attribute, $value): bool
    {
        $this->invalidAges = [];

        foreach ($value as $age) {
            $isValid = $this->ageloadModel->ageExists($age);
            
            if (! $isValid) {
                $this->invalidAges[] = $age;
            }
        }

        return empty($this->invalidAges);
    }

    public function message(): string
    {
        return 'These ages are not within valid age groups: ' . implode(', ', $this->invalidAges);
    }
}
