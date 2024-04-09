<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
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
        return Inertia::render('Url/Shortener', ['status' => session('status')]);
    }

    /**
     * Shorten the url.
     */
    public function shorten(Request $request): RedirectResponse
    {
        $request->url;

        return back()->with('status', 'url-shortened');
    }
}
