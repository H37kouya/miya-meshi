<?php

namespace App\Console\Commands\Args;

class ReplaceTogetherArg
{
    public string $search;

    public string $replace;

    public function __construct(string $search, string $replace)
    {
        $this->search = $search;
        $this->replace = $replace;
    }
}
