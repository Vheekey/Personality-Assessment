<?php


namespace App\Http\Services\MultiStep;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class MultiStepRedirectController
{
    public function __invoke(Request $request): Redirector|Application|RedirectResponse
    {
        return redirect($request->getUri() . '/1');
    }
}
