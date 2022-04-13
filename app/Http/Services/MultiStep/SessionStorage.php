<?php


namespace App\Http\Services\MultiStep;


use Illuminate\Http\Request;

class SessionStorage implements StepStorage
{

    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function put($key, $value)
    {
        return $this->request->session()->put($key, $value);
    }

    public function get($key)
    {
        return $this->request->session()->get($key);
    }

    public function forget($key)
    {
        return $this->request->session()->forget($key);
    }
}
