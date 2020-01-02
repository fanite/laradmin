<?php

namespace Autodev\Index\Http\Controllers;

class IndexController extends Controller
{
    public function index()
    {
        return view('index::index');
    }
}
