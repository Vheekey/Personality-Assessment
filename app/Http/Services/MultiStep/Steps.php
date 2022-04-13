<?php


namespace App\Http\Services\MultiStep;


class Steps
{
    protected string $name;

    protected string $step;

    protected StepStorage $storage;

    public function __construct(StepStorage $storage)
    {
        $this->storage = $storage;
    }

    public function step($name, $step): Steps
    {
        $this->name = $name;
        $this->step = $step;

        return $this;
    }

    public function store($data): Steps
    {
        $this->storage->put($this->key() . ".{$this->step}.data", $data);

        return $this;
    }

    public function complete(): Steps
    {
        $this->storage->put($this->key() . ".{$this->step}.complete", true);

        return $this;
    }

    public function notCompleted(...$steps): bool
    {
        foreach ($steps as $step) {
            if (!$this->storage->get($this->key() . ".{$step}.complete")) {
                return true;
            }
        }

        return false;
    }

    public function data(): array
    {
        return collect($this->storage->get($this->key()))
            ->pluck('data')
            ->flatten()
            ->toArray();
    }

    public function dataBag(): object
    {
        return (object)collect($this->storage->get($this->key()))->pluck('data')->mapWithKeys(function($a) {
            return $a;
        });
    }

    public function clearAll(): Steps
    {
        $this->storage->forget($this->key());

        return $this;
    }

    protected function key(): string
    {
        return "multistep.{$this->name}";
    }

    public function __get($property)
    {
        return $this->storage->get("multistep.{$this->name}.{$this->step}.data.{$property}");
    }
}
