<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function priceFormatted()
    {
        $formattedPrice = 'Rp ' . number_format($this->price, 0, ',', '.');

        return $formattedPrice;
    }

    public function getApiResponseAttribute()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'price_formatted' => $this->priceFormatted(),
        ];
    }
}
