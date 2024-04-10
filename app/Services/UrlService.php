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

            $isUnique = ! Url::where('short_url_hash', $randomString)->exists();

        } while (!$isUnique);

        $shortenedUrl = $baseUrl . $randomString;

        $this->storeShortenedUrl($url, $shortenedUrl, $randomString);

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

    private function storeShortenedUrl(string $url, string $shortenedUrl, string $hash): void
    {
        Url::create([
            'url' => $url,
            'short_url' => $shortenedUrl,
            'short_url_hash' => $hash
        ]);
    }
}
