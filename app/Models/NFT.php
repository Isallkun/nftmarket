<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCan;


class NFT extends Model
{
    use HasFactory;
    use Hascan;

    protected $appends = [
        'can',
    ];

    protected $fillable = [
        'name',
        'collection',
        'price',
        'quantity',
        'description',
        'external_url',
        'author',
        'image',
    ];

    public function getCreatedAtAttribute($value)
    {
        return now()->parse($value)->timezone(config('app.timezone'))->format('d/m/Y H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return now()->parse($value)->timezone(config('app.timezone'))->diffForHumans();
    }
}
