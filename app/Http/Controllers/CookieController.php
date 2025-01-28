<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CookieController extends Controller
{
    public function acceptCookies(Request $request)
    {
        $cookie = cookie('accept_cookies', true, 60 * 24 * 365)
            ->withHttpOnly(false)
            ->withSecure(true);
        return redirect()->back()->withCookie($cookie);
    }
}
