<?php

namespace App\Services;

use App\Models\Url;

class UrlService 
{
    public function getOriginalurl(string $hash): string|null
    {
        return Url::firstWhere('short_url_hash', $hash)?->url;
    }

    public function shortenUrl(string $url): string
    {

        $existingShortenedUrl = $this->checkForDuplicate($url);

        if ($existingShortenedUrl) {
            return $existingShortenedUrl;
        }

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = 6;

        do {
            $randomBytes = random_bytes($length);

            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[ord($randomBytes[$i]) % strlen($characters)];
            }

            $isUnique = ! Url::where('short_url_hash', $randomString)->exists();

        } while (!$isUnique);

        return $this->storeShortenedUrl($url, $randomString);
    }

    private function checkForDuplicate($url): string|null
    {
        $shortenedUrl = Url::firstWhere('url', $url);

        if ($shortenedUrl){
            return $shortenedUrl->short_url;
        }

        return null;
    }

    private function storeShortenedUrl(string $url, string $hash): string
    {
        $urlModel = Url::create([
            'url' => $url,
            'short_url_hash' => $hash
        ]);

        return $urlModel->short_url;
    }
}
