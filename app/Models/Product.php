<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
    ];

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
            'image_url' => $this->getImageUrlAttribute(),
        ];
    }

    protected function getImageUrlAttribute()
    {
        if (is_null($this->image)) {
            return null;
        }

        return asset('storage/' . $this->image);
    }
}
