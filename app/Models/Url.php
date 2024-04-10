<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'short_url_hash'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['short_url'];

    /**
     * Dynamically retrieve the short_url.
     */
    protected function shortUrl(): Attribute
    {
        return new Attribute(
            get: fn () => config('app.url') . '/' . $this->short_url_hash,
        );
    }
}
