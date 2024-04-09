<?php

namespace App\Http\Requests;

use Ariaieboy\LaravelSafeBrowsing\Facades\LaravelSafeBrowsing;
use Illuminate\Foundation\Http\FormRequest;
use Closure;

class UrlShortenerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'url' => [
                'required',
                'url',
                function (string $attribute, mixed $value, Closure $fail) {
                    try {
                        $isSafe = LaravelSafeBrowsing::isSafeUrl($value);
                    } catch (\Throwable $th) {
                        $isSafe = false;
                    }

                    if ($isSafe !== true) {
                        $fail("The {$attribute} is unsafe.");
                    }
                }
            ]
        ];
    }
}
