<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin', [
            'config' => [
                'name' => config('app.name'),
                'debug' => config('app.debug'),
                'url' => config('app.url'),
            ]
        ]);
    }
}
