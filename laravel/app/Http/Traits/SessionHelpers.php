<?php

namespace App\Http\Traits;

trait SessionHelpers
{
    public function add_to_session(string $key, mixed $value): void
    {
        $seleccionadas = session($key) ?: [];

        $seleccionadas = array_unique(array_merge($seleccionadas, [$value]));

        session()->put($key, $seleccionadas);
    }

    public function remove_from_session(string $key, mixed $value): void
    {
        $seleccionadas = session($key) ?: [];

        $seleccionadas = array_diff($seleccionadas, [$value]);

        session()->put($key, $seleccionadas);
    }
}
