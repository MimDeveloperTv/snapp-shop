<?php

namespace App\Pipes;

interface Pipe
{
    public function handle(array|null $passable, \Closure $next);
}
