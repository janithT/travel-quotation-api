<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ageload extends Model
{
    use HasFactory;

    protected $fillable = [
        'min_age',
        'max_age',
        'load'
    ];

    // get age load exists
    public function ageExists(int $age): bool
    {
        return $this->where('min_age', '<=', $age)
                    ->where('max_age', '>=', $age)
                    ->exists();
    }
}
