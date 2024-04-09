<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Http\Requests\UrlShortenerRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UrlController extends Controller
{
    /**
     * Display the url shortener form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Url/Shortener');
    }

    /**
     * Shorten the url.
     */
    public function shorten(UrlShortenerRequest $request): Response
    {
        $url = $request->url;

        $shortenedUrl = Url::firstWhere('url', $url);

        if ($shortenedUrl){
            $data = [
                'data' => [
                    'url' => $shortenedUrl->url,
                    'shortened_url' => $shortenedUrl->shortened_url
                ],
                'status' => 'url-shortened'
            ];
        }

        $data = [
            'data' => [
                'url' => '$shortenedUrl->url',
                'shortened_url' => '$shortenedUrl->shortened_url'
            ],
            'status' => 'url-shortened'
        ];

        return Inertia::render('Url/Shortener', $data);
    }
}
