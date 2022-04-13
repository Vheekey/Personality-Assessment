<?php


namespace App\Http\Services\MultiStep;


use Illuminate\Support\Facades\Route;

class PendingMultiStepRegistration
{

    protected $uri;

    protected $controller;

    protected $steps;

    protected $name;

    public function __construct($uri, $controller)
    {
        $this->uri = $uri;
        $this->controller = $controller;
    }

    public function steps($steps): PendingMultiStepRegistration
    {
        $this->steps = $steps;

        return $this;
    }

    public function name($name): PendingMultiStepRegistration
    {
        $this->name = $name;

        return $this;
    }

    public function __destruct()
    {
        Route::get($this->uri, '\\' . MultiStepRedirectController::class);

        collect()->times($this->steps, function ($step) {
            Route::group([
                'prefix' => $this->uri
            ], function () use ($step) {
                //Route::get($step, '\\' . $this->controller . '@' . $step);
                Route::resource($step, "{$this->controller}Step{$step}")
                    ->only(['index', 'store'])
                    ->names([
                        'index' => "{$this->name}.{$step}.index",
                        'store' => "{$this->name}.{$step}.store",
                    ]);
            });
        });
    }
}
