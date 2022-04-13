<?php


namespace App\Http\Services\MultiStep;


interface StepStorage
{
    public function put($key, $value);
    public function get($key);
    public function forget($key);
}
