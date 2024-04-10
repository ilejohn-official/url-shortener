<?php

namespace App\Services;

use App\Models\Url;

class UrlService 
{
    public function shortenUrl(string $url): string
    {

        $existingShortenedUrl = $this->checkForDuplicate($url);

        if ($existingShortenedUrl) {
            return $existingShortenedUrl;
        }

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = 6;
        $baseUrl = 'https://example.com/';

        do {
            $randomBytes = random_bytes($length);

            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[ord($randomBytes[$i]) % strlen($characters)];
            }

            $isUnique = ! Url::where('short_url', $baseUrl . $randomString)->exists();

        } while (!$isUnique);

        $shortenedUrl = $baseUrl . $randomString;

        $this->storeShortenedUrl($url, $shortenedUrl);

        return $shortenedUrl;
    }

    private function checkForDuplicate($url): string|null
    {
        $shortenedUrl = Url::firstWhere('url', $url);

        if ($shortenedUrl){
            return $shortenedUrl->short_url;
        }

        return null;
    }

    private function storeShortenedUrl($url, $shortenedUrl): void
    {
        Url::create([
            'url' => $url,
            'short_url' => $shortenedUrl
        ]);
    }
}
