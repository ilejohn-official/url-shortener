<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlShortenerRequest;
use App\Services\UrlService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
class UrlController extends Controller
{

    protected $urlService;


    public function __construct(UrlService $urlService)
    {
        $this->urlService = $urlService;
    }

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

        $shortenedUrl = $this->urlService->shortenUrl($url);

        return Inertia::render('Url/Shortener', [
            'data' => [
                'url' => $url,
                'short_url' => $shortenedUrl
            ],
            'status' => 'url-shortened'
        ]);
    }
}
