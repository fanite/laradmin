<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        if (Str::startsWith($key = config('app.key'), 'base64:')) {
            $key = substr($key, 7, 16);
        }

        return view('admin', [
            'config' => [
                'name' => config('app.name'),
                'debug' => config('app.debug'),
                'url' => config('app.url'),
                'secret' => $key
            ]
        ]);
    }
}
