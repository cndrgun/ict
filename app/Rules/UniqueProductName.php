<?php

namespace App\Rules;

use App\Models\Products;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class UniqueProductName implements Rule
{
    private $productId;

    public function __construct($productId = null)
    {
        $this->productId = $productId;
    }

    public function passes($attribute, $value)
    {
        $normalizedValue = Str::ascii(Str::lower($value));

        $query = Products::whereRaw('LOWER(name) = ?', [$normalizedValue]);

        if ($this->productId) {
            $query->where('id', '!=', $this->productId);
        }

        return !$query->exists();
    }

    public function message()
    {
        return 'Bu isimde bir ürün zaten mevcut.';
    }
}
