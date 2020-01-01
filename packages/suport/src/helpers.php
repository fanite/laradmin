<?php

use Illuminate\Http\JsonResponse;

if (!function_exists('xhr_redirect')) {
    /**
     * Get an instance of the redirector.
     *
     * @param  string|null  $to
     * @param  int  $status
     * @param  array  $headers
     * @param  bool|null  $secure
     * @return \Illuminate\Http\RedirectResponse
     */
    function xhr_redirect($to = null, $parameters = [], $status = 302, $headers = [])
    {
        $url = $to ? url($to, $parameters) : url('/');
        return new JsonResponse(['redirect' => $url], $status, $headers);
    }
}
